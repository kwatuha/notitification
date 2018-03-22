
<style>
div.toggler        { border:1px solid #ccc; background:url(gmail2.jpg) 10px 12px #eee no-repeat; cursor:pointer; padding:10px 32px; }
div.toggler .subject  { font-weight:bold; }
div.read          { color:#666; }
div.toggler .from, div.toggler .date { font-style:italic; font-size:11px; }
div.body          { padding:10px 20px; }

</style>
<script src="jquery-1.2.1.pack.js"></script>
<script>
window.addEvent('domready',function() {
  var togglers = $$('div.toggler');
  if(togglers.length) var gmail = new Fx.Accordion(togglers,$$('div.body'));
  togglers.addEvent('click',function() { this.addClass('read').removeClass('unread'); });
  togglers[0].fireEvent('click'); //first one starts out read
});
</script>
<?php 
include('../class.emailattachment.php');
/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'ibasmsrpts@gmail.com';
$password = 'Admin2010@#';
$savedirpath='data';
$directorytest=is_dir($savedirpath);
if(!$directorytest){
				mkdir($savedirpath, 0700);
}


// /* try to connect */
// $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

// /* grab emails */
// $emails = imap_search($inbox,'SUBJECT "300"');

// /* if emails are returned, cycle through each... */
// if($emails) {
  
//   /* begin output var */
//   $output = '';
  
//   /* put the newest emails on top */
//   rsort($emails);
  
//   /* for every email... */
//   foreach($emails as $email_number) {
    
//    /* get information specific to this email */
//     $overview = imap_fetch_overview($inbox,$email_number,0);
//     $message = imap_fetchbody($inbox,$email_number,2);
    
//     /* output the email header information */
//     $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
//     $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
//     $output.= '<span class="from">'.$overview[0]->from.'</span>';
//     $output.= '<span class="date">on '.$overview[0]->date.'</span>';
//     $output.= '</div>';
    
//     /* output the email body */
//     $output.= '<div class="body">'.$message.'</div>';
//   }
  
//   echo $output;
// } 

// /* close the connection */
// imap_close($inbox);
?>
<?php
/*$conn   = imap_open('{imap.example.com:993/imap/ssl}INBOX', 'foo@example.com', 'pass123', OP_READONLY);

$some   = imap_search($conn, 'SUBJECT "Reason Medically Eligible" SINCE "8 August 2011"', SE_UID);
$msgnos = imap_search($conn, 'ALL');
$uids   = imap_search($conn, 'ALL', SE_UID);

print_r($some);
print_r($msgnos);
print_r($uids);*/

// C:\xampp\htdocs\impact\PHPMailer\examples\readmail.php

$readAttachment= new ReadAttachment();
// $readAttachment->getdata($hostname,$username,$password,$savedirpath,$delete_emails=false);

// testMe($hostname,$username,$password);
$readAttachment->getdataLast($hostname,$username,$password,$savedirpath,$delete_emails=false);
// $savedirpath='C:\xampp\htdocs\impact\home\emailReports';
// $readAttachment->getdata( 'smtp.googlemail.com','kwatuha@gmail.com','Admin2016@#',$savedirpath,$delete_emails=false);
?>
<?php

function testMe($hostname,$username,$password){
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox, 'SUBJECT "300"');



/* if emails are returned, cycle through each... */
if($emails) {

  /* begin output var */
  $output = '';

  /* put the newest emails on top */
  rsort($emails);




    foreach($emails as $email_number) {

    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,2);
    $structure = imap_fetchstructure($inbox,$email_number);


    pre($overview);


     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['filename'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }             
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))




    if(count($attachments)!=0){


        foreach($attachments as $at){

            if($at[is_attachment]==1){

                file_put_contents($at[filename], $at[attachment]);

                }
            }

        }

  }

 // echo $output;
} 

/* close the connection */
imap_close($inbox);
}

?>