<?php
/*~ class.phpmailer.php
.---------------------------------------------------------------------------.
|  Software: PHPMailer - PHP email class                                    |
|   Version: 5.2.4                                                          |
|      Site: https://code.google.com/a/apache-extras.org/p/phpmailer/       |
| ------------------------------------------------------------------------- |
|     Admin: Jim Jagielski (project admininistrator)                        |
|   Authors: Andy Prevost (codeworxtech) codeworxtech@users.sourceforge.net |
|          : Marcus Bointon (coolbru) coolbru@users.sourceforge.net         |
|          : Jim Jagielski (jimjag) jimjag@gmail.com                        |
|   Founder: Brent R. Matzelle (original founder)                           |
| Copyright (c) 2010-2012, Jim Jagielski. All Rights Reserved.              |
| Copyright (c) 2004-2009, Andy Prevost. All Rights Reserved.               |
| Copyright (c) 2001-2003, Brent R. Matzelle                                |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
'---------------------------------------------------------------------------'
*/

/**
 * PHPMailer - PHP email creation and transport class
 * NOTE: Requires PHP version 5 or later
 * @package PHPMailer
 * @author Andy Prevost
 * @author Marcus Bointon
 * @author Jim Jagielski
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

if (version_compare(PHP_VERSION, '5.0.0', '<') ) exit("Sorry, this version of PHPMailer will only run on PHP version 5 or greater!\n");

/**
 * PHP email creation and transport class
 * @package PHPMailer
 */
class PHPMailer {

  /////////////////////////////////////////////////
  // PROPERTIES, PUBLIC
  /////////////////////////////////////////////////

  /**
   * Email priority (1 = High, 3 = Normal, 5 = low).
   * @var int
   */
  public $Priority          = 3;

  /**
   * Sets the CharSet of the message.
   * @var string
   */
  public $CharSet           = 'iso-8859-1';

  /**
   * Sets the Content-type of the message.
   * @var string
   */
  public $ContentType       = 'text/plain';

  /**
   * Sets the Encoding of the message. Options for this are
   *  "8bit", "7bit", "binary", "base64", and "quoted-printable".
   * @var string
   */
  public $Encoding          = '8bit';

  /**
   * Holds the most recent mailer error message.
   * @var string
   */
  public $ErrorInfo         = '';

  /**
   * Sets the From email address for the message.
   * @var string
   */
  public $From              = 'root@localhost';

  /**
   * Sets the From name of the message.
   * @var string
   */
  public $FromName          = 'Root User';

  /**
   * Sets the Sender email (Return-Path) of the message.  If not empty,
   * will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
   * @var string
   */
  public $Sender            = '';

  /**
   * Sets the Return-Path of the message.  If empty, it will
   * be set to either From or Sender.
   * @var string
   */
  public $ReturnPath        = '';

  /**
   * Sets the Subject of the message.
   * @var string
   */
  public $Subject           = '';

  /**
   * Sets the Body of the message.  This can be either an HTML or text body.
   * If HTML then run IsHTML(true).
   * @var string
   */
  public $Body              = '';

  /**
   * Sets the text-only body of the message.  This automatically sets the
   * email to multipart/alternative.  This body can be read by mail
   * clients that do not have HTML email capability such as mutt. Clients
   * that can read HTML will view the normal Body.
   * @var string
   */
  public $AltBody           = '';

  /**
   * Stores the complete compiled MIME message body.
   * @var string
   * @access protected
   */
  protected $MIMEBody       = '';

  /**
   * Stores the complete compiled MIME message headers.
   * @var string
   * @access protected
   */
  protected $MIMEHeader     = '';

  /**
   * Stores the extra header list which CreateHeader() doesn't fold in
   * @var string
   * @access protected
  */
  protected $mailHeader     = '';

  /**
   * Sets word wrapping on the body of the message to a given number of
   * characters.
   * @var int
   */
  public $WordWrap          = 0;

  /**
   * Method to send mail: ("mail", "sendmail", or "smtp").
   * @var string
   */
  public $Mailer            = 'mail';

  /**
   * Sets the path of the sendmail program.
   * @var string
   */
  public $Sendmail          = '/usr/sbin/sendmail';

  /**
   * Determine if mail() uses a fully sendmail compatible MTA that
   * supports sendmail's "-oi -f" options
   * @var boolean
   */
  public $UseSendmailOptions  = true;
  
  /**
   * Path to PHPMailer plugins.  Useful if the SMTP class
   * is in a different directory than the PHP include path.
   * @var string
   */
  public $PluginDir         = '';

  /**
   * Sets the email address that a reading confirmation will be sent.
   * @var string
   */
  public $ConfirmReadingTo  = '';

  /**
   * Sets the hostname to use in Message-Id and Received headers
   * and as default HELO string. If empty, the value returned
   * by SERVER_NAME is used or 'localhost.localdomain'.
   * @var string
   */
  public $Hostname          = '';

  /**
   * Sets the message ID to be used in the Message-Id header.
   * If empty, a unique id will be generated.
   * @var string
   */
  public $MessageID         = '';

  /**
   * Sets the message Date to be used in the Date header.
   * If empty, the current date will be added.
   * @var string
   */
  public $MessageDate       = '';

  /////////////////////////////////////////////////
  // PROPERTIES FOR SMTP
  /////////////////////////////////////////////////

  /**
   * Sets the SMTP hosts.
   *
   * All hosts must be separated by a
   * semicolon.  You can also specify a different port
   * for each host by using this format: [hostname:port]
   * (e.g. "smtp1.example.com:25;smtp2.example.com").
   * Hosts will be tried in order.
   * @var string
   */
  public $Host          = 'localhost';

  /**
   * Sets the default SMTP server port.
   * @var int
   */
  public $Port          = 25;

  /**
   * Sets the SMTP HELO of the message (Default is $Hostname).
   * @var string
   */
  public $Helo          = '';

  /**
   * Sets connection prefix. Options are "", "ssl" or "tls"
   * @var string
   */
  public $SMTPSecure    = '';

  /**
   * Sets SMTP authentication. Utilizes the Username and Password variables.
   * @var bool
   */
  public $SMTPAuth      = false;

  /**
   * Sets SMTP username.
   * @var string
   */
  public $Username      = '';

  /**
   * Sets SMTP password.
   * @var string
   */
  public $Password      = '';

  /**
   *  Sets SMTP auth type. Options are LOGIN | PLAIN | NTLM  (default LOGIN)
   *  @var string
   */
  public $AuthType      = '';
  
  /**
   *  Sets SMTP realm.
   *  @var string
   */
  public $Realm         = '';

  /**
   *  Sets SMTP workstation.
   *  @var string
   */
  public $Workstation   = '';

  /**
   * Sets the SMTP server timeout in seconds.
   * This function will not work with the win32 version.
   * @var int
   */
  public $Timeout       = 10;

  /**
   * Sets SMTP class debugging on or off.
   * @var bool
   */
  public $SMTPDebug     = false;

  /**
   * Sets the function/method to use for debugging output.
   * Right now we only honor "echo" or "error_log"
   * @var string
   */
  public $Debugoutput     = "echo";

  /**
   * Prevents the SMTP connection from being closed after each mail
   * sending.  If this is set to true then to close the connection
   * requires an explicit call to SmtpClose().
   * @var bool
   */
  public $SMTPKeepAlive = false;

  /**
   * Provides the ability to have the TO field process individual
   * emails, instead of sending to entire TO addresses
   * @var bool
   */
  public $SingleTo      = false;

   /**
   * If SingleTo is true, this provides the array to hold the email addresses
   * @var bool
   */
  public $SingleToArray = array();

 /**
   * Provides the ability to change the generic line ending
   * NOTE: The default remains '\n'. We force CRLF where we KNOW
   *        it must be used via self::CRLF
   * @var string
   */
  public $LE              = "\n";

   /**
   * Used with DKIM Signing
   * required parameter if DKIM is enabled
   *
   * domain selector example domainkey
   * @var string
   */
  public $DKIM_selector   = '';

  /**
   * Used with DKIM Signing
   * required if DKIM is enabled, in format of email address 'you@yourdomain.com' typically used as the source of the email
   * @var string
   */
  public $DKIM_identity   = '';

  /**
   * Used with DKIM Signing
   * optional parameter if your private key requires a passphras
   * @var string
   */
  public $DKIM_passphrase   = '';

  /**
   * Used with DKIM Singing
   * required if DKIM is enabled, in format of email address 'domain.com'
   * @var string
   */
  public $DKIM_domain     = '';

  /**
   * Used with DKIM Signing
   * required if DKIM is enabled, path to private key file
   * @var string
   */
  public $DKIM_private    = '';

  /**
   * Callback Action function name.
   * The function that handles the result of the send email action.
   * It is called out by Send() for each email sent.
   *
   * Value can be:
   * - 'function_name' for function names
   * - 'Class::Method' for static method calls
   * - array($object, 'Method') for calling methods on $object
   * See http://php.net/is_callable manual page for more details.
   *
   * Parameters:
   *   bool    $result        result of the send action
   *   string  $to            email address of the recipient
   *   string  $cc            cc email addresses
   *   string  $bcc           bcc email addresses
   *   string  $subject       the subject
   *   string  $body          the email body
   *   string  $from          email address of sender
   * @var string
   */
  public $action_function = ''; //'callbackAction';

  /**
   * Sets the PHPMailer Version number
   * @var string
   */
  public $Version         = '5.2.4';

  /**
   * What to use in the X-Mailer header
   * @var string NULL for default, whitespace for None, or actual string to use
   */
  public $XMailer         = '';

  /////////////////////////////////////////////////
  // PROPERTIES, PRIVATE AND PROTECTED
  /////////////////////////////////////////////////

  /**
   * @var SMTP An instance of the SMTP sender class
   * @access protected
   */
  protected   $smtp           = null;
  /**
   * @var array An array of 'to' addresses
   * @access protected
   */
  protected   $to             = array();
  /**
   * @var array An array of 'cc' addresses
   * @access protected
   */
  protected   $cc             = array();
  /**
   * @var array An array of 'bcc' addresses
   * @access protected
   */
  protected   $bcc            = array();
  /**
   * @var array An array of reply-to name and address
   * @access protected
   */
  protected   $ReplyTo        = array();
  /**
   * @var array An array of all kinds of addresses: to, cc, bcc, replyto
   * @access protected
   */
  protected   $all_recipients = array();
  /**
   * @var array An array of attachments
   * @access protected
   */
  protected   $attachment     = array();
  /**
   * @var array An array of custom headers
   * @access protected
   */
  protected   $CustomHeader   = array();
  /**
   * @var string The message's MIME type
   * @access protected
   */
  protected   $message_type   = '';
  /**
   * @var array An array of MIME boundary strings
   * @access protected
   */
  protected   $boundary       = array();
  /**
   * @var array An array of available languages
   * @access protected
   */
  protected   $language       = array();
  /**
   * @var integer The number of errors encountered
   * @access protected
   */
  protected   $error_count    = 0;
  /**
   * @var string The filename of a DKIM certificate file
   * @access protected
   */
  protected   $sign_cert_file = '';
  /**
   * @var string The filename of a DKIM key file
   * @access protected
   */
  protected   $sign_key_file  = '';
  /**
   * @var string The password of a DKIM key
   * @access protected
   */
  protected   $sign_key_pass  = '';
  /**
   * @var boolean Whether to throw exceptions for errors
   * @access protected
   */
  protected   $exceptions     = false;

  /////////////////////////////////////////////////
  // CONSTANTS
  /////////////////////////////////////////////////

  const STOP_MESSAGE  = 0; // message only, continue processing
  const STOP_CONTINUE = 1; // message?, likely ok to continue processing
  const STOP_CRITICAL = 2; // message, plus full stop, critical error reached
  const CRLF = "\r\n";     // SMTP RFC specified EOL
  
  /////////////////////////////////////////////////
  // METHODS, VARIABLES
  /////////////////////////////////////////////////

  /**
   * Calls actual mail() function, but in a safe_mode aware fashion
   * Also, unless sendmail_path points to sendmail (or something that
   * claims to be sendmail), don't pass params (not a perfect fix,
   * but it will do)
   * @param string $to To
   * @param string $subject Subject
   * @param string $body Message Body
   * @param string $header Additional Header(s)
   * @param string $params Params
   * @access private
   * @return bool
   */
  private function mail_passthru($to, $subject, $body, $header, $params) {
    if ( ini_get('safe_mode') || !($this->UseSendmailOptions) ) {
        $rt = @mail($to, $this->EncodeHeader($this->SecureHeader($subject)), $body, $header);
    } else {
        $rt = @mail($to, $this->EncodeHeader($this->SecureHeader($subject)), $body, $header, $params);
    }
    return $rt;
  }

  /**
   * Outputs debugging info via user-defined method
   * @param string $str
   */
  private function edebug($str) {
    if ($this->Debugoutput == "error_log") {
        error_log($str);
    } else {
        echo $str;
    }
  }

  /**
   * Constructor
   * @param boolean $exceptions Should we throw external exceptions?
   */
  public function __construct($exceptions = false) {
    $this->exceptions = ($exceptions == true);
  }

  /**
   * Sets message type to HTML.
   * @param bool $ishtml
   * @return void
   */
  public function IsHTML($ishtml = true) {
    if ($ishtml) {
      $this->ContentType = 'text/html';
    } else {
      $this->ContentType = 'text/plain';
    }
  }

  /**
   * Sets Mailer to send message using SMTP.
   * @return void
   */
  public function IsSMTP() {
    $this->Mailer = 'smtp';
  }

  /**
   * Sets Mailer to send message using PHP mail() function.
   * @return void
   */
  public function IsMail() {
    $this->Mailer = 'mail';
  }

  /**
   * Sets Mailer to send message using the $Sendmail program.
   * @return void
   */
  public function IsSendmail() {
    if (!stristr(ini_get('sendmail_path'), 'sendmail')) {
      $this->Sendmail = '/var/qmail/bin/sendmail';
    }
    $this->Mailer = 'sendmail';
  }

  /**
   * Sets Mailer to send message using the qmail MTA.
   * @return void
   */
  public function IsQmail() {
    if (stristr(ini_get('sendmail_path'), 'qmail')) {
      $this->Sendmail = '/var/qmail/bin/sendmail';
    }
    $this->Mailer = 'sendmail';
  }

  /////////////////////////////////////////////////
  // METHODS, RECIPIENTS
  /////////////////////////////////////////////////

  /**
   * Adds a "To" address.
   * @param string $address
   * @param string $name
   * @return boolean true on success, false if address already used
   */
  public function AddAddress($address, $name = '') {
    return $this->AddAnAddress('to', $address, $name);
  }

  /**
   * Adds a "Cc" address.
   * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
   * @param string $address
   * @param string $name
   * @return boolean true on success, false if address already used
   */
  public function AddCC($address, $name = '') {
    return $this->AddAnAddress('cc', $address, $name);
  }

  /**
   * Adds a "Bcc" address.
   * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
   * @param string $address
   * @param string $name
   * @return boolean true on success, false if address already used
   */
  public function AddBCC($address, $name = '') {
    return $this->AddAnAddress('bcc', $address, $name);
  }

  /**
   * Adds a "Reply-to" address.
   * @param string $address
   * @param string $name
   * @return boolean
   */
  public function AddReplyTo($address, $name = '') {
    return $this->AddAnAddress('Reply-To', $address, $name);
  }

  /**
   * Adds an address to one of the recipient arrays
   * Addresses that have been added already return false, but do not throw exceptions
   * @param string $kind One of 'to', 'cc', 'bcc', 'ReplyTo'
   * @param string $address The email address to send to
   * @param string $name
   * @throws phpmailerException
   * @return boolean true on success, false if address already used or invalid in some way
   * @access protected
   */
  protected function AddAnAddress($kind, $address, $name = '') {
    if (!preg_match('/^(to|cc|bcc|Reply-To)$/', $kind)) {
      $this->SetError($this->Lang('Invalid recipient array').': '.$kind);
      if ($this->exceptions) {
        throw new phpmailerException('Invalid recipient array: ' . $kind);
      }
      if ($this->SMTPDebug) {
        $this->edebug($this->Lang('Invalid recipient array').': '.$kind);
      }
      return false;
    }
    $address = trim($address);
    $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
    if (!$this->ValidateAddress($address)) {
      $this->SetError($this->Lang('invalid_address').': '. $address);
      if ($this->exceptions) {
        throw new phpmailerException($this->Lang('invalid_address').': '.$address);
      }
      if ($this->SMTPDebug) {
        $this->edebug($this->Lang('invalid_address').': '.$address);
      }
      return false;
    }
    if ($kind != 'Reply-To') {
      if (!isset($this->all_recipients[strtolower($address)])) {
        array_push($this->$kind, array($address, $name));
        $this->all_recipients[strtolower($address)] = true;
        return true;
      }
    } else {
      if (!array_key_exists(strtolower($address), $this->ReplyTo)) {
        $this->ReplyTo[strtolower($address)] = array($address, $name);
      return true;
    }
  }
  return false;
}

/**
 * Set the From and FromName properties
 * @param string $address
 * @param string $name
 * @param int $auto Also set Reply-To and Sender
   * @throws phpmailerException
 * @return boolean
 */
  public function SetFrom($address, $name = '', $auto = 1) {
    $address = trim($address);
    $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
    if (!$this->ValidateAddress($address)) {
      $this->SetError($this->Lang('invalid_address').': '. $address);
      if ($this->exceptions) {
        throw new phpmailerException($this->Lang('invalid_address').': '.$address);
      }
      if ($this->SMTPDebug) {
        $this->edebug($this->Lang('invalid_address').': '.$address);
      }
      return false;
    }
    $this->From = $address;
    $this->FromName = $name;
    if ($auto) {
      if (empty($this->ReplyTo)) {
        $this->AddAnAddress('Reply-To', $address, $name);
      }
      if (empty($this->Sender)) {
        $this->Sender = $address;
      }
    }
    return true;
  }

  /**
   * Check that a string looks roughly like an email address should
   * Static so it can be used without instantiation, public so people can overload
   * Conforms to RFC5322: Uses *correct* regex on which FILTER_VALIDATE_EMAIL is
   * based; So why not use FILTER_VALIDATE_EMAIL? Because it was broken to
   * not allow a@b type valid addresses :(
   * Some Versions of PHP break on the regex though, likely due to PCRE, so use
   * the older validation method for those users. (http://php.net/manual/en/pcre.installation.php)
   * @link http://squiloople.com/2009/12/20/email-address-validation/
   * @copyright regex Copyright Michael Rushton 2009-10 | http://squiloople.com/ | Feel free to use and redistribute this code. But please keep this copyright notice.
   * @param string $address The email address to check
   * @return boolean
   * @static
   * @access public
   */
  public static function ValidateAddress($address) {
  if ((defined('PCRE_VERSION')) && (version_compare(PCRE_VERSION, '8.0') >= 0)) {
    return preg_match('/^(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){65,}@)((?>(?>(?>((?>(?>(?>\x0D\x0A)?[   ])+|(?>[  ]*\x0D\x0A)?[   ]+)?)(\((?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)([!#-\'*+\/-9=?^-~-]+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(?>([a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9]{1,4})(?>:(?6)){7}|(?!(?:.*[a-f0-9][:\]]){7,})((?6)(?>:(?6)){0,5})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:|(?!(?:.*[a-f0-9]:){5,})(?8)?::(?>((?6)(?>:(?6)){0,3}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?9)){3}))\])(?1)$/isD', $address);
  } elseif (function_exists('filter_var')) { //Introduced in PHP 5.2
        if(filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
          return false;
        } else {
          return true;
        }
    } else {
        return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
  }
  }

  /////////////////////////////////////////////////
  // METHODS, MAIL SENDING
  /////////////////////////////////////////////////

  /**
   * Creates message and assigns Mailer. If the message is
   * not sent successfully then it returns false.  Use the ErrorInfo
   * variable to view description of the error.
   * @throws phpmailerException
   * @return bool
   */
  public function Send() {
    try {
      if(!$this->PreSend()) return false;
      return $this->PostSend();
    } catch (phpmailerException $e) {
      $this->mailHeader = '';
      $this->SetError($e->getMessage());
      if ($this->exceptions) {
        throw $e;
      }
      return false;
    }
  }

  /**
   * Prep mail by constructing all message entities
   * @throws phpmailerException
   * @return bool
   */
  public function PreSend() {
    try {
      $this->mailHeader = "";
      if ((count($this->to) + count($this->cc) + count($this->bcc)) < 1) {
        throw new phpmailerException($this->Lang('provide_address'), self::STOP_CRITICAL);
      }

      // Set whether the message is multipart/alternative
      if(!empty($this->AltBody)) {
        $this->ContentType = 'multipart/alternative';
      }

      $this->error_count = 0; // reset errors
      $this->SetMessageType();
      //Refuse to send an empty message
      if (empty($this->Body)) {
        throw new phpmailerException($this->Lang('empty_message'), self::STOP_CRITICAL);
      }

      $this->MIMEHeader = $this->CreateHeader();
      $this->MIMEBody = $this->CreateBody();

      // To capture the complete message when using mail(), create
      // an extra header list which CreateHeader() doesn't fold in
      if ($this->Mailer == 'mail') {
        if (count($this->to) > 0) {
          $this->mailHeader .= $this->AddrAppend("To", $this->to);
        } else {
          $this->mailHeader .= $this->HeaderLine("To", "undisclosed-recipients:;");
        }
        $this->mailHeader .= $this->HeaderLine('Subject', $this->EncodeHeader($this->SecureHeader(trim($this->Subject))));
        // if(count($this->cc) > 0) {
            // $this->mailHeader .= $this->AddrAppend("Cc", $this->cc);
        // }
      }

      // digitally sign with DKIM if enabled
      if (!empty($this->DKIM_domain) && !empty($this->DKIM_private) && !empty($this->DKIM_selector) && !empty($this->DKIM_domain) && file_exists($this->DKIM_private)) {
        $header_dkim = $this->DKIM_Add($this->MIMEHeader, $this->EncodeHeader($this->SecureHeader($this->Subject)), $this->MIMEBody);
        $this->MIMEHeader = str_replace("\r\n", "\n", $header_dkim) . $this->MIMEHeader;
      }

      return true;

    } catch (phpmailerException $e) {
      $this->SetError($e->getMessage());
      if ($this->exceptions) {
        throw $e;
      }
      return false;
    }
  }

  /**
   * Actual Email transport function
   * Send the email via the selected mechanism
   * @throws phpmailerException
   * @return bool
   */
  public function PostSend() {
    try {
      // Choose the mailer and send through it
      switch($this->Mailer) {
        case 'sendmail':
          return $this->SendmailSend($this->MIMEHeader, $this->MIMEBody);
        case 'smtp':
          return $this->SmtpSend($this->MIMEHeader, $this->MIMEBody);
        case 'mail':
          return $this->MailSend($this->MIMEHeader, $this->MIMEBody);
        default:
          return $this->MailSend($this->MIMEHeader, $this->MIMEBody);
      }
    } catch (phpmailerException $e) {
      $this->SetError($e->getMessage());
      if ($this->exceptions) {
        throw $e;
      }
      if ($this->SMTPDebug) {
        $this->edebug($e->getMessage()."\n");
      }
    }
    return false;
  }

  /**
   * Sends mail using the $Sendmail program.
   * @param string $header The message headers
   * @param string $body The message body
   * @throws phpmailerException
   * @access protected
   * @return bool
   */
  protected function SendmailSend($header, $body) {
    if ($this->Sender != '') {
      $sendmail = sprintf("%s -oi -f%s -t", escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
    } else {
      $sendmail = sprintf("%s -oi -t", escapeshellcmd($this->Sendmail));
    }
    if ($this->SingleTo === true) {
      foreach ($this->SingleToArray as $val) {
        if(!@$mail = popen($sendmail, 'w')) {
          throw new phpmailerException($this->Lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
        }
        fputs($mail, "To: " . $val . "\n");
        fputs($mail, $header);
        fputs($mail, $body);
        $result = pclose($mail);
        // implement call back function if it exists
        $isSent = ($result == 0) ? 1 : 0;
        $this->doCallback($isSent, $val, $this->cc, $this->bcc, $this->Subject, $body);
        if($result != 0) {
          throw new phpmailerException($this->Lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
        }
      }
    } else {
      if(!@$mail = popen($sendmail, 'w')) {
        throw new phpmailerException($this->Lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
      }
      fputs($mail, $header);
      fputs($mail, $body);
      $result = pclose($mail);
      // implement call back function if it exists
      $isSent = ($result == 0) ? 1 : 0;
      $this->doCallback($isSent, $this->to, $this->cc, $this->bcc, $this->Subject, $body);
      if($result != 0) {
        throw new phpmailerException($this->Lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
      }
    }
    return true;
  }
  /**
   * Sends mail using the PHP mail() function.
   * @param string $header The message headers
   * @param string $body The message body
     * @throws phpmailerException
   * @access protected
   * @return bool
   */
  protected function MailSend($header, $body) {
    $toArr = array();
    foreach($this->to as $t) {
      $toArr[] = $this->AddrFormat($t);
    }
    $to = implode(', ', $toArr);

    if (empty($this->Sender)) {
      $params = "-oi ";
    } else {
      $params = sprintf("-oi -f%s", $this->Sender);
    }
    if ($this->Sender != '' and !ini_get('safe_mode')) {
      $old_from = ini_get('sendmail_from');
      ini_set('sendmail_from', $this->Sender);
    }
      $rt = false;
    if ($this->SingleTo === true && count($toArr) > 1) {
      foreach ($toArr as $val) {
        $rt = $this->mail_passthru($val, $this->Subject, $body, $header, $params);
        // implement call back function if it exists
        $isSent = ($rt == 1) ? 1 : 0;
        $this->doCallback($isSent, $val, $this->cc, $this->bcc, $this->Subject, $body);
      }
    } else {
      $rt = $this->mail_passthru($to, $this->Subject, $body, $header, $params);
      // implement call back function if it exists
      $isSent = ($rt == 1) ? 1 : 0;
      $this->doCallback($isSent, $to, $this->cc, $this->bcc, $this->Subject, $body);
    }
    if (isset($old_from)) {
      ini_set('sendmail_from', $old_from);
    }
    if(!$rt) {
      throw new phpmailerException($this->Lang('instantiate'), self::STOP_CRITICAL);
    }
    return true;
  }

  /**
   * Sends mail via SMTP using PhpSMTP
   * Returns false if there is a bad MAIL FROM, RCPT, or DATA input.
   * @param string $header The message headers
   * @param string $body The message body
   * @throws phpmailerException
   * @uses SMTP
   * @access protected
   * @return bool
   */
  protected function SmtpSend($header, $body) {
    require_once $this->PluginDir . 'class.smtp.php';
    $bad_rcpt = array();

    if(!$this->SmtpConnect()) {
      throw new phpmailerException($this->Lang('smtp_connect_failed'), self::STOP_CRITICAL);
    }
    $smtp_from = ($this->Sender == '') ? $this->From : $this->Sender;
    if(!$this->smtp->Mail($smtp_from)) {
      $this->SetError($this->Lang('from_failed') . $smtp_from . " : " . implode(",",$this->smtp->getError())) ;
      throw new phpmailerException($this->ErrorInfo, self::STOP_CRITICAL);
    }

    // Attempt to send attach all recipients
    foreach($this->to as $to) {
      if (!$this->smtp->Recipient($to[0])) {
        $bad_rcpt[] = $to[0];
        // implement call back function if it exists
        $isSent = 0;
        $this->doCallback($isSent, $to[0], '', '', $this->Subject, $body);
      } else {
        // implement call back function if it exists
        $isSent = 1;
        $this->doCallback($isSent, $to[0], '', '', $this->Subject, $body);
      }
    }
    foreach($this->cc as $cc) {
      if (!$this->smtp->Recipient($cc[0])) {
        $bad_rcpt[] = $cc[0];
        // implement call back function if it exists
        $isSent = 0;
        $this->doCallback($isSent, '', $cc[0], '', $this->Subject, $body);
      } else {
        // implement call back function if it exists
        $isSent = 1;
        $this->doCallback($isSent, '', $cc[0], '', $this->Subject, $body);
      }
    }
    foreach($this->bcc as $bcc) {
      if (!$this->smtp->Recipient($bcc[0])) {
        $bad_rcpt[] = $bcc[0];
        // implement call back function if it exists
        $isSent = 0;
        $this->doCallback($isSent, '', '', $bcc[0], $this->Subject, $body);
      } else {
        // implement call back function if it exists
        $isSent = 1;
        $this->doCallback($isSent, '', '', $bcc[0], $this->Subject, $body);
      }
    }


    if (count($bad_rcpt) > 0 ) { //Create error message for any bad addresses
      $badaddresses = implode(', ', $bad_rcpt);
      throw new phpmailerException($this->Lang('recipients_failed') . $badaddresses);
    }
    if(!$this->smtp->Data($header . $body)) {
      throw new phpmailerException($this->Lang('data_not_accepted'), self::STOP_CRITICAL);
    }
    if($this->SMTPKeepAlive == true) {
      $this->smtp->Reset();
    } else {
        $this->smtp->Quit();
        $this->smtp->Close();
    }
    return true;
  }

  /**
   * Initiates a connection to an SMTP server.
   * Returns false if the operation failed.
   * @uses SMTP
   * @access public
   * @throws phpmailerException
   * @return bool
   */
  public function SmtpConnect() {
    if(is_null($this->smtp)) {
      $this->smtp = new SMTP;
    }

    $this->smtp->Timeout = $this->Timeout;
    $this->smtp->do_debug = $this->SMTPDebug;
    $hosts = explode(';', $this->Host);
    $index = 0;
    $connection = $this->smtp->Connected();

    // Retry while there is no connection
    try {
      while($index < count($hosts) && !$connection) {
        $hostinfo = array();
        if (preg_match('/^(.+):([0-9]+)$/', $hosts[$index], $hostinfo)) {
          $host = $hostinfo[1];
          $port = $hostinfo[2];
        } else {
          $host = $hosts[$index];
          $port = $this->Port;
        }

        $tls = ($this->SMTPSecure == 'tls');
        $ssl = ($this->SMTPSecure == 'ssl');

        if ($this->smtp->Connect(($ssl ? 'ssl://':'').$host, $port, $this->Timeout)) {

          $hello = ($this->Helo != '' ? $this->Helo : $this->ServerHostname());
          $this->smtp->Hello($hello);

          if ($tls) {
            if (!$this->smtp->StartTLS()) {
              throw new phpmailerException($this->Lang('connect_host'));
            }

            //We must resend HELO after tls negotiation
            $this->smtp->Hello($hello);
          }

          $connection = true;
          if ($this->SMTPAuth) {
            if (!$this->smtp->Authenticate($this->Username, $this->Password, $this->AuthType,
                                           $this->Realm, $this->Workstation)) {
              throw new phpmailerException($this->Lang('authenticate'));
            }
          }
        }
        $index++;
      if (!$connection) {
        throw new phpmailerException($this->Lang('connect_host'));
      }
      }
    } catch (phpmailerException $e) {
      $this->smtp->Reset();
      if ($this->exceptions) {
        throw $e;
      }
    }
    return true;
  }

  /**
   * Closes the active SMTP session if one exists.
   * @return void
   */
  public function SmtpClose() {
    if ($this->smtp !== null) {
      if($this->smtp->Connected()) {
        $this->smtp->Quit();
        $this->smtp->Close();
      }
    }
  }

  /**
  * Sets the language for all class error messages.
  * Returns false if it cannot load the language file.  The default language is English.
  * @param string $langcode ISO 639-1 2-character language code (e.g. Portuguese: "br")
  * @param string $lang_path Path to the language file directory
   * @return bool
  * @access public
  */
  function SetLanguage($langcode = 'en', $lang_path = 'language/') {
    //Define full set of translatable strings
    $PHPMAILER_LANG = array(
      'authenticate'         => 'SMTP Error: Could not authenticate.',
      'connect_host'         => 'SMTP Error: Could not connect to SMTP host.',
      'data_not_accepted'    => 'SMTP Error: Data not accepted.',
      'empty_message'        => 'Message body empty',
      'encoding'             => 'Unknown encoding: ',
      'execute'              => 'Could not execute: ',
      'file_access'          => 'Could not access file: ',
      'file_open'            => 'File Error: Could not open file: ',
      'from_failed'          => 'The following From address failed: ',
      'instantiate'          => 'Could not instantiate mail function.',
      'invalid_address'      => 'Invalid address',
      'mailer_not_supported' => ' mailer is not supported.',
      'provide_address'      => 'You must provide at least one recipient email address.',
      'recipients_failed'    => 'SMTP Error: The following recipients failed: ',
      'signing'              => 'Signing Error: ',
      'smtp_connect_failed'  => 'SMTP Connect() failed.',
      'smtp_error'           => 'SMTP server error: ',
      'variable_set'         => 'Cannot set or reset variable: '
    );
    //Overwrite language-specific strings. This way we'll never have missing translations - no more "language string failed to load"!
    $l = true;
    if ($langcode != 'en') { //There is no English translation file
      $l = @include $lang_path.'phpmailer.lang-'.$langcode.'.php';
    }
    $this->language = $PHPMAILER_LANG;
    return ($l == true); //Returns false if language not found
  }

  /**
  * Return the current array of language strings
  * @return array
  */
  public function GetTranslations() {
    return $this->language;
  }

  /////////////////////////////////////////////////
  // METHODS, MESSAGE CREATION
  /////////////////////////////////////////////////

  /**
   * Creates recipient headers.
   * @access public
   * @param string $type
   * @param array $addr
   * @return string
   */
  public function AddrAppend($type, $addr) {
    $addr_str = $type . ': ';
    $addresses = array();
    foreach ($addr as $a) {
      $addresses[] = $this->AddrFormat($a);
    }
    $addr_str .= implode(', ', $addresses);
    $addr_str .= $this->LE;

    return $addr_str;
  }

  /**
   * Formats an address correctly.
   * @access public
   * @param string $addr
   * @return string
   */
  public function AddrFormat($addr) {
    if (empty($addr[1])) {
      return $this->SecureHeader($addr[0]);
    } else {
      return $this->EncodeHeader($this->SecureHeader($addr[1]), 'phrase') . " <" . $this->SecureHeader($addr[0]) . ">";
    }
  }

  /**
   * Wraps message for use with mailers that do not
   * automatically perform wrapping and for quoted-printable.
   * Original written by philippe.
   * @param string $message The message to wrap
   * @param integer $length The line length to wrap to
   * @param boolean $qp_mode Whether to run in Quoted-Printable mode
   * @access public
   * @return string
   */
  public function WrapText($message, $length, $qp_mode = false) {
    $soft_break = ($qp_mode) ? sprintf(" =%s", $this->LE) : $this->LE;
    // If utf-8 encoding is used, we will need to make sure we don't
    // split multibyte characters when we wrap
    $is_utf8 = (strtolower($this->CharSet) == "utf-8");
    $lelen = strlen($this->LE);
    $crlflen = strlen(self::CRLF);

    $message = $this->FixEOL($message);
    if (substr($message, -$lelen) == $this->LE) {
      $message = substr($message, 0, -$lelen);
    }

    $line = explode($this->LE, $message);   // Magic. We know FixEOL uses $LE
    $message = '';
    for ($i = 0 ;$i < count($line); $i++) {
      $line_part = explode(' ', $line[$i]);
      $buf = '';
      for ($e = 0; $e<count($line_part); $e++) {
        $word = $line_part[$e];
        if ($qp_mode and (strlen($word) > $length)) {
          $space_left = $length - strlen($buf) - $crlflen;
          if ($e != 0) {
            if ($space_left > 20) {
              $len = $space_left;
              if ($is_utf8) {
                $len = $this->UTF8CharBoundary($word, $len);
              } elseif (substr($word, $len - 1, 1) == "=") {
                $len--;
              } elseif (substr($word, $len - 2, 1) == "=") {
                $len -= 2;
              }
              $part = substr($word, 0, $len);
              $word = substr($word, $len);
              $buf .= ' ' . $part;
              $message .= $buf . sprintf("=%s", self::CRLF);
            } else {
              $message .= $buf . $soft_break;
            }
            $buf = '';
          }
          while (strlen($word) > 0) {
            $len = $length;
            if ($is_utf8) {
              $len = $this->UTF8CharBoundary($word, $len);
            } elseif (substr($word, $len - 1, 1) == "=") {
              $len--;
            } elseif (substr($word, $len - 2, 1) == "=") {
              $len -= 2;
            }
            $part = substr($word, 0, $len);
            $word = substr($word, $len);

            if (strlen($word) > 0) {
              $message .= $part . sprintf("=%s", self::CRLF);
            } else {
              $buf = $part;
            }
          }
        } else {
          $buf_o = $buf;
          $buf .= ($e == 0) ? $word : (' ' . $word);

          if (strlen($buf) > $length and $buf_o != '') {
            $message .= $buf_o . $soft_break;
            $buf = $word;
          }
        }
      }
      $message .= $buf . self::CRLF;
    }

    return $message;
  }

  /**
   * Finds last character boundary prior to maxLength in a utf-8
   * quoted (printable) encoded string.
   * Original written by Colin Brown.
   * @access public
   * @param string $encodedText utf-8 QP text
   * @param int    $maxLength   find last character boundary prior to this length
   * @return int
   */
  public function UTF8CharBoundary($encodedText, $maxLength) {
    $foundSplitPos = false;
    $lookBack = 3;
    while (!$foundSplitPos) {
      $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
      $encodedCharPos = strpos($lastChunk, "=");
      if ($encodedCharPos !== false) {
        // Found start of encoded character byte within $lookBack block.
        // Check the encoded byte value (the 2 chars after the '=')
        $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
        $dec = hexdec($hex);
        if ($dec < 128) { // Single byte character.
          // If the encoded char was found at pos 0, it will fit
          // otherwise reduce maxLength to start of the encoded char
          $maxLength = ($encodedCharPos == 0) ? $maxLength :
          $maxLength - ($lookBack - $encodedCharPos);
          $foundSplitPos = true;
        } elseif ($dec >= 192) { // First byte of a multi byte character
          // Reduce maxLength to split at start of character
          $maxLength = $maxLength - ($lookBack - $encodedCharPos);
          $foundSplitPos = true;
        } elseif ($dec < 192) { // Middle byte of a multi byte character, look further back
          $lookBack += 3;
        }
      } else {
        // No encoded character found
        $foundSplitPos = true;
      }
    }
    return $maxLength;
  }


  /**
   * Set the body wrapping.
   * @access public
   * @return void
   */
  public function SetWordWrap() {
    if($this->WordWrap < 1) {
      return;
    }

    switch($this->message_type) {
      case 'alt':
      case 'alt_inline':
      case 'alt_attach':
      case 'alt_inline_attach':
        $this->AltBody = $this->WrapText($this->AltBody, $this->WordWrap);
        break;
      default:
        $this->Body = $this->WrapText($this->Body, $this->WordWrap);
        break;
    }
  }

  /**
   * Assembles message header.
   * @access public
   * @return string The assembled header
   */
  public function CreateHeader() {
    $result = '';

    // Set the boundaries
    $uniq_id = md5(uniqid(time()));
    $this->boundary[1] = 'b1_' . $uniq_id;
    $this->boundary[2] = 'b2_' . $uniq_id;
    $this->boundary[3] = 'b3_' . $uniq_id;

    if ($this->MessageDate == '') {
      $result .= $this->HeaderLine('Date', self::RFCDate());
    } else {
      $result .= $this->HeaderLine('Date', $this->MessageDate);
    }

    if ($this->ReturnPath) {
      $result .= $this->HeaderLine('Return-Path', trim($this->ReturnPath));
    } elseif ($this->Sender == '') {
      $result .= $this->HeaderLine('Return-Path', trim($this->From));
    } else {
      $result .= $this->HeaderLine('Return-Path', trim($this->Sender));
    }

    // To be created automatically by mail()
    if($this->Mailer != 'mail') {
      if ($this->SingleTo === true) {
        foreach($this->to as $t) {
          $this->SingleToArray[] = $this->AddrFormat($t);
        }
      } else {
        if(count($this->to) > 0) {
          $result .= $this->AddrAppend('To', $this->to);
        } elseif (count($this->cc) == 0) {
          $result .= $this->HeaderLine('To', 'undisclosed-recipients:;');
        }
      }
    }

    $from = array();
    $from[0][0] = trim($this->From);
    $from[0][1] = $this->FromName;
    $result .= $this->AddrAppend('From', $from);

    // sendmail and mail() extract Cc from the header before sending
    if(count($this->cc) > 0) {
      $result .= $this->AddrAppend('Cc', $this->cc);
    }

    // sendmail and mail() extract Bcc from the header before sending
    if((($this->Mailer == 'sendmail') || ($this->Mailer == 'mail')) && (count($this->bcc) > 0)) {
      $result .= $this->AddrAppend('Bcc', $this->bcc);
    }

    if(count($this->ReplyTo) > 0) {
      $result .= $this->AddrAppend('Reply-To', $this->ReplyTo);
    }

    // mail() sets the subject itself
    if($this->Mailer != 'mail') {
      $result .= $this->HeaderLine('Subject', $this->EncodeHeader($this->SecureHeader($this->Subject)));
    }

    if($this->MessageID != '') {
      $result .= $this->HeaderLine('Message-ID', $this->MessageID);
    } else {
      $result .= sprintf("Message-ID: <%s@%s>%s", $uniq_id, $this->ServerHostname(), $this->LE);
    }
    $result .= $this->HeaderLine('X-Priority', $this->Priority);
    if ($this->XMailer == '') {
        $result .= $this->HeaderLine('X-Mailer', 'PHPMailer '.$this->Version.' (http://code.google.com/a/apache-extras.org/p/phpmailer/)');
    } else {
      $myXmailer = trim($this->XMailer);
      if ($myXmailer) {
        $result .= $this->HeaderLine('X-Mailer', $myXmailer);
      }
    }

    if($this->ConfirmReadingTo != '') {
      $result .= $this->HeaderLine('Disposition-Notification-To', '<' . trim($this->ConfirmReadingTo) . '>');
    }

    // Add custom headers
    for($index = 0; $index < count($this->CustomHeader); $index++) {
      $result .= $this->HeaderLine(trim($this->CustomHeader[$index][0]), $this->EncodeHeader(trim($this->CustomHeader[$index][1])));
    }
    if (!$this->sign_key_file) {
      $result .= $this->HeaderLine('MIME-Version', '1.0');
      $result .= $this->GetMailMIME();
    }

    return $result;
  }

  /**
   * Returns the message MIME.
   * @access public
   * @return string
   */
  public function GetMailMIME() {
    $result = '';
    switch($this->message_type) {
      case 'inline':
        $result .= $this->HeaderLine('Content-Type', 'multipart/related;');
        $result .= $this->TextLine("\tboundary=\"" . $this->boundary[1] . '"');
        break;
      case 'attach':
      case 'inline_attach':
      case 'alt_attach':
      case 'alt_inline_attach':
        $result .= $this->HeaderLine('Content-Type', 'multipart/mixed;');
        $result .= $this->TextLine("\tboundary=\"" . $this->boundary[1] . '"');
        break;
      case 'alt':
      case 'alt_inline':
        $result .= $this->HeaderLine('Content-Type', 'multipart/alternative;');
        $result .= $this->TextLine("\tboundary=\"" . $this->boundary[1] . '"');
        break;
      default:
        // Catches case 'plain': and case '':
        $result .= $this->HeaderLine('Content-Transfer-Encoding', $this->Encoding);
        $result .= $this->TextLine('Content-Type: '.$this->ContentType.'; charset='.$this->CharSet);
        break;
    }

    if($this->Mailer != 'mail') {
      $result .= $this->LE;
    }

    return $result;
  }

  /**
   * Returns the MIME message (headers and body). Only really valid post PreSend().
   * @access public
   * @return string
   */
  public function GetSentMIMEMessage() {
    return $this->MIMEHeader . $this->mailHeader . self::CRLF . $this->MIMEBody;
  }


  /**
   * Assembles the message body.  Returns an empty string on failure.
   * @access public
   * @throws phpmailerException
   * @return string The assembled message body
   */
  public function CreateBody() {
    $body = '';

    if ($this->sign_key_file) {
      $body .= $this->GetMailMIME().$this->LE;
    }

    $this->SetWordWrap();

    switch($this->message_type) {
      case 'inline':
        $body .= $this->GetBoundary($this->boundary[1], '', '', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->AttachAll("inline", $this->boundary[1]);
        break;
      case 'attach':
        $body .= $this->GetBoundary($this->boundary[1], '', '', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->AttachAll("attachment", $this->boundary[1]);
        break;
      case 'inline_attach':
        $body .= $this->TextLine("--" . $this->boundary[1]);
        $body .= $this->HeaderLine('Content-Type', 'multipart/related;');
        $body .= $this->TextLine("\tboundary=\"" . $this->boundary[2] . '"');
        $body .= $this->LE;
        $body .= $this->GetBoundary($this->boundary[2], '', '', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->AttachAll("inline", $this->boundary[2]);
        $body .= $this->LE;
        $body .= $this->AttachAll("attachment", $this->boundary[1]);
        break;
      case 'alt':
        $body .= $this->GetBoundary($this->boundary[1], '', 'text/plain', '');
        $body .= $this->EncodeString($this->AltBody, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->GetBoundary($this->boundary[1], '', 'text/html', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->EndBoundary($this->boundary[1]);
        break;
      case 'alt_inline':
        $body .= $this->GetBoundary($this->boundary[1], '', 'text/plain', '');
        $body .= $this->EncodeString($this->AltBody, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->TextLine("--" . $this->boundary[1]);
        $body .= $this->HeaderLine('Content-Type', 'multipart/related;');
        $body .= $this->TextLine("\tboundary=\"" . $this->boundary[2] . '"');
        $body .= $this->LE;
        $body .= $this->GetBoundary($this->boundary[2], '', 'text/html', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->AttachAll("inline", $this->boundary[2]);
        $body .= $this->LE;
        $body .= $this->EndBoundary($this->boundary[1]);
        break;
      case 'alt_attach':
        $body .= $this->TextLine("--" . $this->boundary[1]);
        $body .= $this->HeaderLine('Content-Type', 'multipart/alternative;');
        $body .= $this->TextLine("\tboundary=\"" . $this->boundary[2] . '"');
        $body .= $this->LE;
        $body .= $this->GetBoundary($this->boundary[2], '', 'text/plain', '');
        $body .= $this->EncodeString($this->AltBody, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->GetBoundary($this->boundary[2], '', 'text/html', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->EndBoundary($this->boundary[2]);
        $body .= $this->LE;
        $body .= $this->AttachAll("attachment", $this->boundary[1]);
        break;
      case 'alt_inline_attach':
        $body .= $this->TextLine("--" . $this->boundary[1]);
        $body .= $this->HeaderLine('Content-Type', 'multipart/alternative;');
        $body .= $this->TextLine("\tboundary=\"" . $this->boundary[2] . '"');
        $body .= $this->LE;
        $body .= $this->GetBoundary($this->boundary[2], '', 'text/plain', '');
        $body .= $this->EncodeString($this->AltBody, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->TextLine("--" . $this->boundary[2]);
        $body .= $this->HeaderLine('Content-Type', 'multipart/related;');
        $body .= $this->TextLine("\tboundary=\"" . $this->boundary[3] . '"');
        $body .= $this->LE;
        $body .= $this->GetBoundary($this->boundary[3], '', 'text/html', '');
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        $body .= $this->LE.$this->LE;
        $body .= $this->AttachAll("inline", $this->boundary[3]);
        $body .= $this->LE;
        $body .= $this->EndBoundary($this->boundary[2]);
        $body .= $this->LE;
        $body .= $this->AttachAll("attachment", $this->boundary[1]);
        break;
      default:
        // catch case 'plain' and case ''
        $body .= $this->EncodeString($this->Body, $this->Encoding);
        break;
    }

    if ($this->IsError()) {
      $body = '';
    } elseif ($this->sign_key_file) {
      try {
        $file = tempnam('', 'mail');
        file_put_contents($file, $body); //TODO check this worked
        $signed = tempnam("", "signed");
        if (@openssl_pkcs7_sign($file, $signed, "file://".$this->sign_cert_file, array("file://".$this->sign_key_file, $this->sign_key_pass), NULL)) {
          @unlink($file);
          $body = file_get_contents($signed);
          @unlink($signed);
        } else {
          @unlink($file);
          @unlink($signed);
          throw new phpmailerException($this->Lang("signing").openssl_error_string());
        }
      } catch (phpmailerException $e) {
        $body = '';
        if ($this->exceptions) {
          throw $e;
        }
      }
    }

    return $body;
  }

  /**
   * Returns the start of a message boundary.
   * @access protected
   * @param string $boundary
   * @param string $charSet
   * @param string $contentType
   * @param string $encoding
   * @return string
   */
  protected function GetBoundary($boundary, $charSet, $contentType, $encoding) {
    $result = '';
    if($charSet == '') {
      $charSet = $this->CharSet;
    }
    if($contentType == '') {
      $contentType = $this->ContentType;
    }
    if($encoding == '') {
      $encoding = $this->Encoding;
    }
    $result .= $this->TextLine('--' . $boundary);
    $result .= sprintf("Content-Type: %s; charset=%s", $contentType, $charSet);
    $result .= $this->LE;
    $result .= $this->HeaderLine('Content-Transfer-Encoding', $encoding);
    $result .= $this->LE;

    return $result;
  }

  /**
   * Returns the end of a message boundary.
   * @access protected
   * @param string $boundary
   * @return string
   */
  protected function EndBoundary($boundary) {
    return $this->LE . '--' . $boundary . '--' . $this->LE;
  }

  /**
   * Sets the message type.
   * @access protected
   * @return void
   */
  protected function SetMessageType() {
    $this->message_type = array();
    if($this->AlternativeExists()) $this->message_type[] = "alt";
    if($this->InlineImageExists()) $this->message_type[] = "inline";
    if($this->AttachmentExists()) $this->message_type[] = "attach";
    $this->message_type = implode("_", $this->message_type);
    if($this->message_type == "") $this->message_type = "plain";
  }

  /**
   *  Returns a formatted header line.
   * @access public
   * @param string $name
   * @param string $value
   * @return string
   */
  public function HeaderLine($name, $value) {
    return $name . ': ' . $value . $this->LE;
  }

  /**
   * Returns a formatted mail line.
   * @access public
   * @param string $value
   * @return string
   */
  public function TextLine($value) {
    return $value . $this->LE;
  }

  /////////////////////////////////////////////////
  // CLASS METHODS, ATTACHMENTS
  /////////////////////////////////////////////////

  /**
   * Adds an attachment from a path on the filesystem.
   * Returns false if the file could not be found
   * or accessed.
   * @param string $path Path to the attachment.
   * @param string $name Overrides the attachment name.
   * @param string $encoding File encoding (see $Encoding).
   * @param string $type File extension (MIME) type.
   * @throws phpmailerException
   * @return bool
   */