$(document).ready(function () {
    H5F.setup(jQuery('form[data-toggle="validator"]'));

    // Contador de caracateres
    $(document).on("input", "[id$=descricao]", function () {
        var limite = $("[id$=descricao]").attr("maxlength");
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresDigitados > limite) {
            $("[id$=descricao]").val($("[id$=descricao]").val().substring(0, limite - 1));
        }

        $(".caracteres").text(caracteresRestantes);
    });
});

function checkLoginState() {
    FB.getLoginStatus(function (response) {
		console.log(response);
        if (response.status == 'connected') {
            onLogin(response);
        } else {
            FB.login(function (response) {
                onLogin(response);
            }, { scope: 'email'});
        }
    });
}

function onLogin(response) {
    if (response.status == 'not_authorized') {
        window.top.location.href = "https://www.facebook.com/GovernodoRS?fref=ts";
    }

    if (response.status == 'connected') {
        FB.api('/me?fields=name,first_name,last_name,email,link', function (data) {
            $('[id$=nome]').html(data.name);
            $('[id$=facebookId]').val(data.id);
            $('[id$=facebookLink]').val(data.link);
            $('[id$=facebookName]').val(data.name);
            $('[id$=facebookEmail]').val(data.email);
        });
    }
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '757237151070756',
        xfbml: true,
        version: 'v2.4'
    });

    checkLoginState();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    //js.src = "//connect.facebook.net/en_US/sdk/debug.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
















    