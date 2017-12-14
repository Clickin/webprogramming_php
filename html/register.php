<html>
    
    <?php 
    $title = "회원가입";
    include("navbar.php");?>
    <script>
        function blank_up(){
    
            var docu = document.forms[0];
            if(docu['name'].value == ""){
                alert("이름을 입력해주세요");
                docu['name'].focus();
                return false;
            }
            
            if(docu['use'].value == '0'){
                alert("아이디 중복을 확인해주세요.");
                docu['id'].focus();
                return false;
            }

            if(docu['id'].value == ""){
                alert("아이디를 입력해주세요");
                docu['id'].focus();
                return false;
            }
            
            if(docu['phone'].value == ""){
                alert("전화번호를 입력해주세요");
                docu['phone'].focus();
                return false;
            }
            
            if(docu['user_pw'].value == ""){
                alert("패스워드를 입력해주세요");
                password.focus();
                return false;
            }
            
            if(docu['user_pw'].value != docu['user_pw2'].value){
                alert("패스워드를 정확하게 입력해주세요.");
                docu['user_pw2'].focus();
                return false;
            }
            
            if(docu['agree'].value != "Yes"){
                alert("약관에 동의 해주시기 바랍니다.");
                docu['agree'].focus();
                return false;
            }
            
    }

    function check_pw(val){
    
        var password = document.getElementById("user_pw").value;
        var passwordCheck = document.getElementById("user_pw2").value;
        var same = "<span style='color:green;'>비밀번호가 일치합니다</span>";
        var diff = "<span style='color:red;'>비밀번호가 일치하지 않습니다</span>";
        
        if(password == passwordCheck){
            document.getElementById("check").innerHTML = same;
        }
        else{
            document.getElementById("check").innerHTML = diff;
        }      
    }

    $(document).ready(function(){
        $('#user_id').blur(function(){
            $.ajax({
                type: 'POST',
                url: '/checkid.php',
                data: {
                    "user_id" : $('#user_id').val()
                },
                success : function s(a){ $('#idch').html(a); },
                error : function error(){ alert('시스템 문제발생');}

            });    //end ajax    
        });    //end on    
    });

    </script>
    <body>
        
        <div class="container">
            <div class="page-header pull-center">
                <h1>회원가입</h1>
            </div>

            <form class="form" id="register" role="form" method="post" action="./register_ok.php">
                <div class="form-group">
                    <label for="user_id">아이디</label>
                    <input class="form-control" name="user_id" id = "user_id" type="text" placeholder="아이디" required>
                </div>
                <div class="form-group" id="idch">아이디를 입력하세요. 
                    <input type="hidden" value="0" name="use"> 
                </div>
                <div class="form-group">
                    <label for="user_pw">비밀번호</label>
                    <input class="form-control" id="user_pw" name="user_pw" type="password" placeholder="비밀번호" required>
                </div>
                <div class="form-group">
                    <label for="user_pw2">비밀번호 확인</label>
                    <input class="form-control" id="user_pw2" name="user_pw2" type="password" placeholder="비밀번호 확인" onkeyup="check_pw(this.value)" required>
                </div>
                <div id="check">비밀번호를 확인해주세요</div>
                <div class="form-group">
                    <label for="name">이름</label>
                    <input class="form-control" name="name" type="text" placeholder="이름" required>
                </div>
                <div class="form-group">
                    <label for="phone">휴대전화</label>
                    <input class="form-control" name="phone" type="tel" placeholder="휴대전화" pattern="^\d{3}\d{3,4}\d{4}$" required>
                </div>
                
                <div class="form-group">
                        <label for="agree">약관에 동의하시겠습니까?</label>
                        <input type="checkbox" name="agree" value="Yes" required>
                </div>

                <div>
                    <button class="btn btn-primary pull-center" type="submit" form="register" id="submit" name="submit" value="submit" onclick="return blank_up()">제출</button>
                    <button class="btn btn-danger pull-center" type="reset" form="register" value="reset">초기화</button>
                </div>
            
            </form>
        </div>
    </html>