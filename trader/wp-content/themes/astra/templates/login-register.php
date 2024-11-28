<?php
/**
 * Template Name: Login Template
 * Description:  
 */
get_header();
?>  
 
    <style>
        .site-header,.site-footer{
            display:none;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            transition: background-color 0.5s ease;
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 320px;
            transition: all 0.3s ease;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            border-color: #0073aa;
            box-shadow: 0 0 5px rgba(0, 115, 170, 0.3);
        }
        .btn {
            background-color: #0073aa;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn:hover {
            background-color: #005177;
        }
        .social-login {
            margin-top: 30px;
            text-align: center;
        }
        .social-btn {
            display: inline-block;
            margin: 0 5px;
            padding: 10px 15px;
            border-radius: 3px;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .facebook { background-color: #3b5998; }
        .google { background-color: #db4437; }
        .twitter { background-color: #1da1f2; }
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .hidden {
            display: none;
        }
        #message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 3px;
            text-align: center;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .form-toggle {
            text-align: center;
            margin-top: 20px;
        }
        .form-toggle a {
            color: #0073aa;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-toggle a:hover {
            color: #005177;
        }
        .captcha-refresh {
            cursor: pointer;
            color: #0073aa;
            font-size: 14px;
            margin-left: 5px;
        }
        .captcha-refresh:hover {
            color: #005177;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .shake {
            animation: shake 0.5s;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 id="form-title">Login</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group hidden" id="email-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="captcha">Captcha: What is <span id="captcha-question"></span>? <span class="captcha-refresh">(Refresh)</span></label>
                <input type="number" id="captcha" name="captcha" required>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
        <div class="form-toggle">
            <a href="#" id="toggle-form">Register</a> | 
            <a href="#" id="forgot-password">Forgot Password?</a>
        </div>
        <div class="social-login">
            <a href="#" class="social-btn facebook">Facebook</a>
            <a href="#" class="social-btn google">Google</a>
            <a href="#" class="social-btn twitter">Twitter</a>
        </div>
        <div id="message"></div>
    </div>

    <script>
        $(document).ready(function() {
            let isLogin = true;
            let captchaAnswer;

            function generateCaptcha() {
                const num1 = Math.floor(Math.random() * 10) + 1;
                const num2 = Math.floor(Math.random() * 10) + 1;
                captchaAnswer = num1 + num2;
                $('#captcha-question').text(`${num1} + ${num2}`);
            }

            generateCaptcha();

            $('.captcha-refresh').click(function(e) {
                e.preventDefault();
                generateCaptcha();
                $('#captcha').val('');
            });

            $('#toggle-form').click(function(e) {
                e.preventDefault();
                isLogin = !isLogin;
                $('#form-title').text(isLogin ? 'Login' : 'Register');
                $('#email-group').slideToggle(300);
                $(this).text(isLogin ? 'Register' : 'Login');
                $('#login-form')[0].reset();
                $('#message').removeClass().empty().hide();
                $('.login-container').css('height', isLogin ? 'auto' : '480px');
            });

            $('#forgot-password').click(function(e) {
                e.preventDefault();
                alert('Password reset functionality would be implemented here.');
            });

            $('.form-group input').focus(function() {
                $(this).parent().find('label').css('color', '#0073aa');
            }).blur(function() {
                $(this).parent().find('label').css('color', '#555');
            });

            $('#login-form').submit(function(e) {
                e.preventDefault();
                const captchaInput = parseInt($('#captcha').val());
                if (captchaInput !== captchaAnswer) {
                    $('#message').removeClass().addClass('error').text('Incorrect captcha. Please try again.').hide().fadeIn(300);
                    $('#captcha').val('').focus();
                    generateCaptcha();
                    $('.login-container').addClass('shake');
                    setTimeout(function() {
                        $('.login-container').removeClass('shake');
                    }, 500);
                    return;
                }

                const formData = {
                    action: isLogin ? 'login' : 'register',
                    username: $('#username').val(),
                    password: $('#password').val(),
                    email: $('#email').val()
                };

                $.ajax({
                    url: 'login-process.php',
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        $('.btn').text('Processing...').prop('disabled', true);
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        $('#message').removeClass().addClass(result.status).text(result.message).hide().fadeIn(300);
                        if (result.status === 'success') {
                            $('body').css('background-color', '#d4edda');
                            setTimeout(function() {
                                window.location.href = 'dashboard.php';
                            }, 2000);
                        } else {
                            generateCaptcha();
                            $('#captcha').val('');
                            $('.btn').text('Submit').prop('disabled', false);
                        }
                    },
                    error: function() {
                        $('#message').removeClass().addClass('error').text('An error occurred. Please try again.').hide().fadeIn(300);
                        generateCaptcha();
                        $('#captcha').val('');
                        $('.btn').text('Submit').prop('disabled', false);
                    }
                });
            });

            // Hover effects for social buttons
            $('.social-btn').hover(
                function() {
                    $(this).css('transform', 'translateY(-3px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script> 
<?php get_footer(); ?>