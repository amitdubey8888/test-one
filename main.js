function checkme(){
    var fname = document.getElementById('first_name').value;
    var lname = document.getElementById('last_name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var phone = document.getElementById('phone').value;
    var letters = /^[a-zA-Z]+$/;
    var numbers = /^[0-9]+$/;

    if(!fname.match(letters)){
        document.getElementById('ferror').innerHTML = 'Only character are allowed in name.';
        $("#submit").addClass('disabled');  
    }else{
        document.getElementById('ferror').innerHTML = '';
        $("#submit").removeClass('disabled');   
    }
    if(!lname.match(letters)){
        document.getElementById('lerror').innerHTML = 'Only character are allowed in name.';
        $("#submit").addClass('disabled');    
    }else{
        document.getElementById('lerror').innerHTML = '';
        $("#submit").removeClass('disabled');   
    }
    function validateMail(mail) {
        var lastAtPos = mail.lastIndexOf('@');
        var lastDotPos = mail.lastIndexOf('.');
        return (lastAtPos < lastDotPos && lastAtPos > 0 && mail.indexOf('@@') == -1 && lastDotPos > 2 && (mail.length - lastDotPos) > 2);
    }
    if(!validateMail(email)){
        $("#submit").addClass('disabled');    
        document.getElementById('emailerror').innerHTML = 'Invalid email!';
    }else{
        document.getElementById('emailerror').innerHTML = '';
        $("#submit").removeClass('disabled');        
    }
    if(password.length <= 6){
        document.getElementById('passworderror').innerHTML = 'Password should be minimum 6 character!';
        $("#submit").addClass('disabled');    
    }else{
        document.getElementById('passworderror').innerHTML = '';
        $("#submit").removeClass('disabled');        
    }
    if(!phone.match(numbers)){
        document.getElementById('phoneerror').innerHTML = 'Only digits are allowed in number.';
        $("#submit").addClass('disabled');    
    }else{
        document.getElementById('phoneerror').innerHTML = '';
        $("#submit").removeClass('disabled');        
    }
}