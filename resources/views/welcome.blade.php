<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mastodon Create OAuth2 Application</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <style>
            html, body {
                background-color: #fff;
                color: #000000;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                line-height: 25px;
            }
            .container {
                width: 600px;
            }

            .form-check-inline { float: left; margin-right: 20px; }

            footer {
                border-top: 1px solid #ccc;
                margin-top: 40px;
                padding-top: 10px;
            }

            .github-img {
                height: 30px;
                display: inline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form>

                <div class="col-md-12 text-center">
                    <br><img width="200" class="align-center" src="https://assets.mastodon.social/assets/fluffy-elephant-friend-6b47d8e924332955795ff4b2d8fc446437d26b28bfc67d6be2a4d88995ab2c1f.png" alt="Mastodon">
                </div>

                <div class="col-md-12">

                    <h2>Create Mastodon OAuth2 Application</h2>
                    <p>You can use the form below to easily create an OAuth2 application on any Mastodon instance. This
                        will return you a <code>client_id</code> and <code>client_secret</code> for you to then use in
                        your application. <strong>This runs completely within your browser and is secure.</strong></p>

                    <div class="form-group">
                        <label for="iptInstance">Mastodon Instance</label>
                        <input type="text" id="iptInstance" class="form-control" placeholder="mastodon.social" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="iptName">Application Name (required)</label>
                        <input type="text" id="iptName" class="form-control" placeholder="My Awesome Mastodon App" required>
                    </div>

                    <div class="form-group">
                        <label for="iptCallback">Redirect URI (required)</label>
                        <input type="text" id="iptCallback" class="form-control" placeholder="https://your.site/callback" required>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <label>Scopes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="read"> Read
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="write"> Write
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="follow"> Follow
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                    <div id="messageHolder" class="alert alert-info">Complete the fields above and click 'Create Application' to continue.</div>
                </div>

                <div class="col-md-12">
                    <button id="btnCreateApp" class="btn btn-md btn-primary" type="submit">Create Application</button>
                </div>

                <div class="col-md-12">
                    <footer class="text-center">
                        Built by <a href="https://dor.ky">Scott Wilcox</a> &middot; Feedback via <a href="https://github.com/ssx/mastodon-create-app"><img class="github-img" src="https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png" alt="Github"></a>
                    </footer>
                </div>
            </form>
        </div>

        <script
                src="https://code.jquery.com/jquery-1.12.4.min.js"
                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous"></script>

        <script>

            $(document).ready(function() {
                function displayError(text) {
                    $("#messageHolder").html("<p>Error: " + text + "</p>").addClass("alert-danger");
                }

                function displaySuccess(text) {
                    $("#messageHolder").html(text).addClass("alert-success");
                }


                $("#btnCreateApp").on("click", function(e) {
                    e.preventDefault();

                   var appRequestDomain        = $("#iptInstance");
                   var appRequestClientName    = $("#iptName");
                   var appRequestCallback      = $("#iptCallback");
                   var appRequestScopes        = $(".form-check-input:checked");
                   var errorCount              = 0;

                   // Check to see that scopes are selected
                   if (appRequestScopes.length === 0) {
                       errorCount++; displayError("You haven't selected any scopes to request.");
                   }

                   // If no instance if provided, set a default one
                   if (appRequestDomain.val() === "") {
                       appRequestDomain.val("mastodon.social");
                   }

                   // Check a callback was provided
                   if (appRequestCallback.val() === "") {
                       errorCount++; displayError("You haven't set a callback URL."); appRequestCallback.focus();
                   }

                   if (appRequestClientName.val() === "") {
                       errorCount++; displayError("You haven't provided a name for your application."); appRequestClientName.focus();
                   }

                   if (errorCount === 0) {

                       var scopes =
                       $.ajax({
                           type: "POST",
                           url: "https://" + appRequestDomain.val() + "/api/v1/apps",
                           data: {
                               client_name: appRequestClientName.val(),
                               redirect_uris: appRequestCallback.val(),
                               scopes: appRequestScopes.map(function () {
                                   return this.value;
                               }).get().join(' ')
                           },
                           success: function(data, status, xhr) {
                               displaySuccess("<p>Your create request was successful.</p><br>" +
                               "<p>Your <code>client_id</code> is:<br>" + data.client_id + "</p>" +
                               "<p>Your <code>client_secret</code> is:<br>" + data.client_secret + "</p><br>" +
                               "<p>Your app ID is " + data.id + "</p>");
                           },
                           error: function() {
                               displayError("There was an error requesting to create your application. One of your input parameters may be malformed.");
                           }
                       });

                   }

                   return false;
               });
            });
        </script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-97693324-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>
