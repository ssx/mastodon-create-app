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
                        your application.</p>
                    <br>
                    <div class="form-group">
                        <label for="iptInstance">Mastodon Instance</label>
                        <input type="text" id="iptInstance" class="form-control" placeholder="mastodon.social" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="iptInstance">Application Name</label>
                        <input type="text" id="iptInstance" class="form-control" placeholder="My Awesome Mastodon App" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="iptInstance">Redirect URI</label>
                        <input type="text" id="iptInstance" class="form-control" placeholder="https://your.site/callback" required autofocus>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <label>Scopes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="scopes[]" value="read"> Read
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="scopes[]" value="write"> Write
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="scopes[]" value="follow" disabled> Follow
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                    <button class="btn btn-md btn-primary" type="submit">Create Application</button>
                    <button class="btn btn-md btn-info" type="submit">Show Curl Command</button>
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
    </body>
</html>
