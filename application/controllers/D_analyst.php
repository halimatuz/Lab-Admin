<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'assets/vendor/autoload.php';
class D_analyst extends CI_Controller 
{
    public function index() {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth/errors_403');
		} else {
            $data = array(
                'title' => "Dashboard"
            );
            
            $data['total_sampler'] = $this->web->get_count('sampler');
            $data['total_institution'] = $this->web->get_count('institution');
            $data['total_coa'] = count($this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result());
            $data['total_quotation'] = $this->web->get_count('sk_number');
            $this->load->view('analyst/_layout/header', $data);
            $this->load->view('analyst/_layout/sidebar');
            $this->load->view('analyst/pages/index');
            $this->load->view('analyst/_layout/footer');
        }
    }

    public function list_quotation() {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array (
                'title' =>  'List Quotation'
            );

            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
            $this->load->view('analyst/_layout/header', $data);
            $this->load->view('analyst/_layout/sidebar');
            $this->load->view('analyst/pages/D_listquotation', $data);
            $this->load->view('analyst/_layout/footer');
        } 
    }

    public function data_quotation_coa()
    {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('analyst/_layout/header', $data);
        $this->load->view('analyst/_layout/sidebar');
        $this->load->view('analyst/pages/D_listquotation', $data);
        $this->load->view('analyst/_layout/footer');
        }
    }
    
    public function input_result($id, $id_sk)
    {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data COA',
        );
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id")->result();

        $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        $this->load->view('analyst/_layout/header', $data);
        $this->load->view('analyst/_layout/sidebar');
        $this->load->view('analyst/pages/D_inputresult', $data);
        $this->load->view('analyst/_layout/footer');
    }
    }

    public function save_result() {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id_result = $this->input->post('id_result');
        $result = $this->input->post('result');
        $vehicle_brand = $this->input->post('vehicle_brand');
        $time = $this->input->post('time');
        $humidity = $this->input->post('humidity');
        $wet = $this->input->post('wet');
        $dew = $this->input->post('dew');
        $globe = $this->input->post('globe');
        $wbgt_index = $this->input->post('wbgt_index');
        $sampling_location = $this->input->post('sampling_location');
        $code = $this->input->post('code');
        $opacity = $this->input->post('opacity');
        $leq = $this->input->post('leq');
        $ls = $this->input->post('ls');
        $lm = $this->input->post('lm');
        $lsm = $this->input->post('lsm');
        $id_sk = $this->input->post('id_sk');
        $today = date ( "Y-m-d" );
        $no_certificate = 'DIL-' . date('Y') . date('m') . date('d') . 'COA';

        $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->row();

        if($data['sk_number']->date_report == NULL) {
            $data_number = array(
                'no_certificate' => $no_certificate,
                'date_report' => $today
            );
            
            $where_sk = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('sk_number', $data_number, $where_sk);
        }

        for($i=0; $i<sizeof($id_result); $i++) {

            $data = array(
                'result' => @$result[$i],
                'vehicle_brand' => @$vehicle_brand[$i],
                'time' => @$time[$i],
                'humidity' => @$humidity[$i],
                'wet' => @$wet[$i],
                'dew' => @$dew[$i],
                'globe' => @$globe[$i],
                'wbgt_index' => @$wbgt_index[$i],
                'sampling_location' => @$sampling_location[$i],
                'code' => @$code[$i],
                'opacity' => @$opacity[$i],
                'leq' => @$leq[$i],
                'ls' => @$ls[$i],
                'lm' => @$lm[$i],
                'lsm' => @$lsm[$i],
            );


            $where = array(
                'id_result' => $id_result[$i]
            );

            $this->web->update_data('result_coa', $data, $where);
        }

        $name_int = $this->input->post('name_int');
        $no_certificate_coa = $this->input->post('no_certificate');

        // Encrypt for email params 
        function encryptId($id_sk) {
            $encrypt_method = "AES-256-CBC";
            $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR";
            $iv = "DASFDSYHFSDUYFFSD";
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $iv), 0, 16);
            $encrypt = openssl_encrypt($id_sk, $encrypt_method, $key, 0, $iv);
            $encrypt = base64_encode($encrypt);
            return $encrypt;
        }

        $institution = $this->db->query("SELECT * FROM company_profile")->row();

        // Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);
			//Server settings
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    	// Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'akunpokemon1976@gmail.com';            // SMTP username
			$mail->Password   = 'wdmzhkwiqcwvrcvh';                         // SMTP password
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		
			//Recipients
			$mail->setFrom('akunpokemon1976@gmail.com', 'PT. DELTA INDONESIA LABORATORY');
			$mail->addAddress($institution->director_email, 'DIRECTOR LABORATORY');     // Add a recipient
			
			$mail->addReplyTo('akunpokemon1976@gmail.com', 'PT. DELTA INDONESIA LABORATORY');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
		
			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Pesan Dari PT. DELTA INDONESIA LABORATORY';
			$mail->Body    = '<!DOCTYPE HTML
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
                        <xml>
                          <o:OfficeDocumentSettings>
                            <o:AllowPNG/>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                          </o:OfficeDocumentSettings>
                        </xml>
                        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                table,
                td {
                    color: #000000;
                }
        
                a {
                    color: #e67e23;
                    text-decoration: underline;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_1 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_1 .v-src-max-width {
                        max-width: 36% !important;
                    }
        
                    #u_content_button_1 .v-size-width {
                        width: 93% !important;
                    }
                }
        
                @media only screen and (min-width: 620px) {
                    .u-row {
                        width: 600px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 600px !important;
                    }
        
                }
        
                @media (max-width: 620px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                    font-family: "Lato";
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet"
                type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body"
            style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #081933;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table
                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #081933;width:100%"
                cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #081933;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="100%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636434047367-bb.png"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div style="width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_1" role="presentation" cellpadding="0"
                                                        cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 30px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
                                                                                <a href="https://unlayer.com" target="_blank">
                                                                                    <img align="center" border="0"
                                                                                        src="https://i.pinimg.com/564x/ac/16/cc/ac16cc581acefe12a5cad7039b133b14.jpg"
                                                                                        alt="Logo" title="Logo"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 20%;max-width: 116px;"
                                                                                        width="116"
                                                                                        class="v-src-width v-src-max-width" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://img.freepik.com/premium-vector/check-mark-document-mail-envelope-approved-email-message-computer-screen-vector-flat-illustration_662353-784.jpg"
                                                                                    alt="Hero Image" title="Hero Image"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 70%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #f7f7f7;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="background-color: #fff;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 44px 30px;"
                                                                    align="left">
        
                                                                    <h1
                                                                        style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-size: 24px;">
                                                                        <strong>Draft COA '. $no_certificate_coa .'
                                                                            Telah Dibuat!</strong>
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #fff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f7f7f7;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 44px 30px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #333333; line-height: 200%; text-align: left; word-wrap: break-word;">
                                                                        <p style="line-height: 200%; font-size: 12px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">Draft
                                                                                COA untuk
                                                                                '. $name_int .',</span></p>
                                                                        <p style="line-height: 200%; font-size: 12px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">Draft
                                                                                COA berhasil dibuat, apabila ada
                                                                                kesalahan dalam draft mohon untuk menghubungi
                                                                                admin Delta Indonesia Laboratory lebih lanjut.
                                                                                Jika draft sudah sesuai silahkan klik tombol
                                                                                approve dibawah ini.</span></p>
                                                                        <p style="line-height: 200%; font-size: 12px; margin-top:10px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">'. base_url("D_draft/draft_coa/") . encryptId($id_sk) .'</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 44px 8px;"
                                                                    align="left">
        
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table id="u_content_button_1" role="presentation" cellpadding="0"
                                                        cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <div align="center">
                                                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:60px; v-text-anchor:middle; width:372px;" arcsize="5%" stroke="f" fillcolor="#2a74f1"><w:anchorlock/><center style="color:#FFFFFF;"><![endif]-->
                                                                        <a href="https://unlayer.com" target="_blank"
                                                                            class="v-size-width"
                                                                            style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #2DD99A; border-radius: 3px;-webkit-border-radius: 3px; -moz-border-radius: 3px; width:64%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
                                                                            <span
                                                                                style="display:block;padding:19px 30px;line-height:120%;"><span
                                                                                    style="font-size: 18px; line-height: 21.6px;"><strong><span
                                                                                            style="line-height: 21.6px; font-size: 18px;">APPROVE</span></strong></span></span>
                                                                        </a>
                                                                        <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 30px 70px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #333333; line-height: 190%; text-align: left; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 190%;"><span
                                                                                style="font-size: 16px; line-height: 30.4px;">Hormat
                                                                                kami,</span></p>
                                                                        <p style="font-size: 14px; line-height: 190%;"><span
                                                                                style="font-size: 16px; line-height: 30.4px;"><strong>PT.
                                                                                    Delta Indonesia Laboratory</strong></span>
                                                                        </p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636435417479-ggg.jpg"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;"
                                                                    align="left">
        
                                                                    <div align="center">
                                                                        <div style="display: table; max-width:95px;">
                                                                            <!--[if (mso)|(IE)]><table width="95" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:95px;"><tr><![endif]-->
        
        
                                                                            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 16px;" valign="top"><![endif]-->
                                                                            <table align="left" border="0" cellspacing="0"
                                                                                cellpadding="0" width="32" height="32"
                                                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 16px">
                                                                                <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                        <td align="left" valign="middle"
                                                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                            <a href="https://www.linkedin.com/in/smk-plus-pelita-nusantara-44b7b2148/"
                                                                                                title="LinkedIn"
                                                                                                target="_blank">
                                                                                                <img src="https://i.pinimg.com/564x/22/7c/5c/227c5cc96b0e77302c09e4797b18089b.jpg"
                                                                                                    alt="LinkedIn"
                                                                                                    title="LinkedIn" width="32"
                                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if (mso)|(IE)]></td><![endif]-->
        
                                                                            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
                                                                            <table align="left" border="0" cellspacing="0"
                                                                                cellpadding="0" width="32" height="32"
                                                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
                                                                                <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                        <td align="left" valign="middle"
                                                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                            <a href="https://www.instagram.com/smkpluspelitanusantara/"
                                                                                                title="Instagram"
                                                                                                target="_blank">
                                                                                                <img src="https://i.pinimg.com/564x/85/84/ba/8584bab434a376e6df23c92e69da62eb.jpg"
                                                                                                    alt="Instagram"
                                                                                                    title="Instagram" width="32"
                                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if (mso)|(IE)]></td><![endif]-->
        
        
                                                                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                        </div>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="55%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 20px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #8d8c8c; line-height: 190%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 190%;">Jika kamu
                                                                            memiliki pertanyaan, bisa hubungi kami lewat <span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;"><span
                                                                                    style="color: #f1602a; font-size: 14px; line-height: 26.6px; text-decoration: underline;"><span
                                                                                        style="font-size: 14px; line-height: 26.6px;">support@mailus.com</span>.
                                                                                </span></span><br />Ruko
                                                                            Prima Orchard No.C 2 Prima Harapan <br> Regency
                                                                            Bekasi
                                                                            Utara, Kota Bekasi 17123, Provinsi Jawa
                                                                            Barat<br /><span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Terms
                                                                                of use</span> | <span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Privacy
                                                                                Policy</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636435800013-footer%20curve.png"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="100%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
                            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--[if mso]></div><![endif]-->
            <!--[if IE]></div><![endif]-->
        </body>
        
        </html>'; 
        
        if($mail->send())
		{
			$this->session->set_flashdata('msg', 'Pesan berhasil terkirim!');
		}
		else{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

        $this->session->set_flashdata('msg', 'Input result success!');
        redirect('D_analyst/input_result/' . $this->input->post('id_analysis') . '/' . $id_sk);
        }
    }

    public function profile(){
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => "Profile"
        );
        $data['user'] = $this->db->query("SELECT * FROM user WHERE email = '$sess'")->result();
        $this->load->view('analyst/_layout/header', $data);
        $this->load->view('analyst/_layout/sidebar');
        $this->load->view('analyst/pages/D_profile');
        $this->load->view('analyst/_layout/footer');
        }
    }


    public function settings() {
        $sess = $this->session->userdata('id_analyst');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => "Settings"
        );

        $this->load->view('analyst/_layout/header', $data);
        $this->load->view('analyst/_layout/sidebar');
        $this->load->view('analyst/pages/D_settings');
        $this->load->view('analyst/_layout/footer');
        }
    }
    
}