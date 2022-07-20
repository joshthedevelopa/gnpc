<?php


/**
 * determines the request response to send
 */
trait Response
{
      private  $responses = array
      (
     'invalidFields'=> array
      (
            'status'=>200,
            'title'=>'error',
            'text' => 'Invalid Fields Specified.'
      ),
      'emptyFields'=> array
      (
            'status'=>200,
            'title'=>'error',
            'text' => 'Required Fields Cannot be Empty'
      ),
      'invalidData'=> array
      (     
            'status'=>200,
            'title'=>'error',
            'text' => 'Invalid Data Supplied.',
            'invalidfields' => '',
            'helpUrl' => ''
      ),
       'badRequest' =>array
        (
            'status'=>200,
            'title'=>'error',
            'text' => 'Bad Request',
            'helpUrl' => ''
        ),
        'notFound'=> array
         (  
            'status'=>RESOURCE_NOT_FOUND,
            'title'=>'error',
            'text' => 'Requested Page Not Found'
         ),
         'pwdChanged'=>array
          (  
               'status'=>OK,
             'title'=>'success', 
             'text'=>'password successfully changed'
          ),
        'pwdMismatch'=>array
        (
            'status'=>UNAUTHORIZED,
             'title'=>'error', 
             'text'=>'Password Mismatch'
        ),
         'loggedOut'=>array
         (
             'status'=>OK,
             'title'=>'success',
             'text'=>'logged out',
             "_links"=>array
            (
                "login"=>array
                (
                    "href"=>"https://www.servicetomato.com/api/servicetomato/users/login",
                    "method"=>"POST",
                    "body"=>"contact, pwd"
                )
            )
         ),
    
        'invalidContact'=>array
        (
            'status'=>200,
            'title'=>'error',
            'text'=>'invalid Contact'
        ),
        'triesExceeded'=>array
        (
            'status'=>200,
            'title'=>'error',
            'text'=>'Maximum tries reached. Try again in 5 minutes'
        ),
        'noPendingData'=>array
        (
            'status'=>200,
            'title'=>'error',
            'text'=>'No Pending Data. Please Enter required data to continue'
        ),
        'authenFailed'=>array
        (
            'status'=>UNAUTHORIZED,
            'title'=>'error',
            'text'=>'Authentication Failed.'
        ),
        'updated'=>array
        (
            'status'=>OK,
            'title'=>'success',
            'text'=>'successfully updated'
        ),
        'unknownErr'=>array
        (
            'status'=>INTERNAL_SERVER_ERROR,
            'title'=>'error',
            'text'=>'unknown error'
        ),
        'codeRequired'=>array
        (
            'status'=>200,
            'title'=>'error',
            'text'=>'Please Enter Verification Code',
            "_links"=>array
            (
                "self"=>array
                (
                    "href"=>"https://www.servicetomato.com/api/servicetomato/users/",
                    "method"=>"POST",
                    "body"=>"verifCode"
                )
            )
        ),
        'codeSent'=>array
        (
            'status'=>OK,
            'title'=>'success',
            "text"=>"didn't get code? Make sure contact is valid and resend code",
            "_links"=>array
            (
                "resendCode"=>array
                (
                    "href"=>"https://www.servicetomato.com/api/servicetomato/users/code",
                    "method"=>"GET",
                    "body"=>"false"
                )
            )
        ),
        'loginFailed'=>array
        (
            'status'=>UNAUTHORIZED,
            
            "_links"=>array
            (
                "self"=>array
                (
                    "href"=>"https://www.servicetomato.com/api/servicetomato/users/login",
                    "method"=>"POST",
                    "body"=>"contact, pwd"
                )
            )
        ),
       "accountCreated"=>array
       (    'status'=>OK,
            'title' => 'success',
            'text' => 'Account successfully created'
       ),
        "loggedIn"=>array
       (    'status'=> OK,
            'title' => 'success',
            'text' => 'logged in',
            "_links"=>array
            (
                "logout"=>array
                (
                    "href"=>"https://www.servicetomato.com/api/servicetomato/users/logout",
                    "method"=>"GET",
                    "body"=>"false"
                )
            )
        )
    );

   

}
