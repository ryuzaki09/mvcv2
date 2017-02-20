var User = (function(){
    var $inputs = $('input');
    var userType = $('select[name=userType]');

    var createUser = function(){
        $('button.create').on('click', function(e){
            var isvalidate = $('#userform').valid();
            if (isvalidate) {
                e.preventDefault(); 
                var pwd1 = $('input[name=pwd1]').val();
                var pwd2 = $('input[name=pwd2]').val();

                if (pwd1 != pwd2) {
                    alert("Passwords do not match!");
                    return;
                }
                var data = getFormDetails();

                var req = ajaxReq("/user/process-create", data);
                req.done(function(data){
                    alert(data.message);
                    if (data.success) {
                        $('table').append(data.html);
                        $inputs.val('');
                        userType.val('');
                    }
                });
            }
        });
    }

    var editAction = function(){
        $(document).on('click', 'button.edit', function(){
            var id = $(this).data("item");
            var $tr = $(this).parents("tr");
            var firstname = $tr.find("td:first-child").text();
            var lastname = $tr.find("td:nth-child(2)").text();
            var email = $tr.find("td:nth-child(3)").text();
            var user_type = $tr.find("td:nth-child(4)").text();
            var username = $tr.find("td:nth-child(5)").text();
            $('input[name=firstname]').val(firstname);
            $('input[name=lastname]').val(lastname);
            $('input[name=email]').val(email);
            $('select[name=userType]').val(user_type);
            $('input[name=username]').val(username);
            $('input[name=userid]').val(id);
            $('button.create').hide();
            $('button.update').show();

            $('input[type=password]').removeAttr("required");
        });
    }

    var updateUser = function(){
        $(document).on("click", "button.update", function(e){

            var isvalidate = $('#userform').valid();
            if (isvalidate) {
                e.preventDefault(); 
                //check if new password is enetered
                var pwd1 = $('input[name=pwd1]').val();
                var pwd2 = $('input[name=pwd2]').val();

                if (pwd1 != pwd2) {
                    alert("Passwords do not match");
                    return;
                }

                var postdata = getFormDetails();
                postdata['id'] = $('input[name=userid]').val();
                console.log(postdata);

                var req = ajaxReq("/user/process-update", postdata);
                req.done(function(data){
                    alert(data.message);
                    if (data.success) {
                        var $tr = $('table').find("button[data-item='" + postdata['id'] + "']").parents("tr");
                        console.log($tr);
                        $tr.find("td:first-child").text(postdata['firstname']);
                        $tr.find("td:nth-child(2)").text(postdata['lastname']);
                        $tr.find("td:nth-child(3)").text(postdata['email']);
                        $tr.find("td:nth-child(4)").text(postdata['userType']);
                        $tr.find("td:nth-child(5)").text(postdata['username']);
                        $('button.create').show();
                        $('button.update').hide();
                        $inputs.val('');
                        userType.val('');
                        $('input[type=password]').attr("required", "required");

                    }
                });
            }
        });
    }

    function getFormDetails(){
        return {
                firstname: $('input[name=firstname]').val().trim(),
                lastname: $('input[name=lastname]').val().trim(),
                userType: $('select[name=userType]').val(),
                email: $('input[name=email]').val().trim(),
                username: $('input[name=username]').val().trim(),
                pwd: $('input[name=pwd1]').val()
            }

    }

    function ajaxReq(url, data){
        return $.ajax({
            url: url,
            data:data,
            dataType:"json",
            method: "POST"
        });
    }

    var init = function(){
        createUser();
        editAction();
        updateUser();
    }

    return {
        init: init
    }


})();
User.init();
