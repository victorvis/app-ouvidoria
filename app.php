<?php 
	require_once "recaptchalib.php";
	
	$siteKey = "6LcqNg0TAAAAAAxjF7_U_wfkGfgbSlLDyWIq4Nsy";
	$secret = "6LcqNg0TAAAAADaC9IwqBczACv4QzoWvP4E1sHxR";

	$resp = "";
	$reCaptcha = new ReCaptcha($secret);
	
	// Was there a reCAPTCHA response?
	if($_POST){
		//var_dump($_POST);exit;
	
		if ($_POST["g-recaptcha-response"]) {
			$resp = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
			);
		}
	}	
	
	
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR">
<head runat="server">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Central de Informação RS</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/facebook-ouvidoria.css" type="text/css" />
</head>
<body>
    <form id="form1" data-toggle="validator" role="form" method="POST">
        <div class="container">

            <div class="header clearfix">
                <ul class="nav navbar-nav">
                    <li>
                        <img src="imgs/logo-estado.png" width="50" />
                    </li>
                    <li>
                        <h1>Cental de Informação <small>Ouvidoria-Geral do Estado</small></h1>
                    </li>
                </ul>
            </div>

			<?php if ($resp != null && $resp->success) { ?>
				<div id="pnl-success">
					<div class="row">
						<div class="col-md-12 text-center" style="padding-top:20px;">
							<p class="lead">Sua solicitação foi enviada com sucesso!</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 protocolo">
							<p>Nùmero Protocolo:</p>
							<code id="nroProtocolo">32335</code>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="margin-bottom:45px">
							<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula. </p>
							<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.</p>
							<p style="padding:10px;" class="text-center">
								<a href="app.php">click aqui para retornar</a>
							</p>
						</div>
					</div>
				</div>			
			<?php } else { ?>
			
				<div id="pnlForm">

					<?php if ($resp != null && !$resp->success) { ?>
						<div class="row">
							<div class="col-md-12">
								<div id="validateAlert" class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert"aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<p><strong>Erro!</strong> Verifique o captcha.</p>
								</div>
							</div>
						</div>
					<?php } ?>

					<div class="row">
						<div class="col-md-12" style="margin-bottom:20px;">
							<p class="lead">Olá <label id="nome"></p>
							<p>Para um melhor atendimento, bem como para que a solicitação possa ser respondida, recomendamos o preenchimento de todos os campos abaixo.</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">

							<!-- Tipo de demanda -->
							<div class="form-group form-group-sm has-feedback">
								<label for="idTipoDemanda" class="control-label">O que deseja fazer</label>
								<select required="" data-error="Selecione o que deseja fazer" class="form-control required" id="tipoDemanda" name="tipoDemanda">
									<option value="">Selecione</option>
									<option value="35">Elogio</option>
									<option value="36">Reclamação</option>
									<option value="37">Solicitação</option>
									<option value="38">Sugestão</option>
								</select>	
								<span class="glyphicon form-control-feedback" aria-hidden="true" style="margin-right: 16px;"></span>
							</div>

							<!-- Assunto da Demanda -->
							<div class="form-group form-group-sm has-feedback">
								<label for="idAssunto" class="control-label">Área a que se refere</label>
								<select required="" data-error="Selecione a área que se refere" class="form-control required" id="assunto" name="assunto">
									<option value="">Selecione</option>
									<option value="2206">Atendimento</option>
									<option value="230">Saúde</option>
									<option value="234">Turismo</option>
									<option value="2212">Violência Escolar</option>
								</select>							
								<span class="glyphicon form-control-feedback" aria-hidden="true" style="margin-right: 16px;"></span>
							</div>

							<!-- Título da demanda -->
							<div class="form-group form-group-sm has-feedback">
								<label for="assunto" class="control-label">Assunto</label>
								<input type="text" class="form-control" id="titulo" name="titulo" data-error="Preencha o título" required />
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>

							<!-- Descrição da demanda -->
							<div class="form-group form-group-sm has-feedback">
								<label for="descricao" class="control-label">Descricão</label>
								<textarea class="form-control" rows="3" id="descricao" name="descricao" maxlength="1000" data-error="Preencha a descrição" required ></textarea>
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div id="conta-caracter" class="text-right">
									<span class="caracteres">1000</span> caracteres restantes
								</div>
							</div>

							<div class="form-group form-group-sm">
								<center><div id="googleRecapctha" class="g-recaptcha" data-sitekey="6LcqNg0TAAAAAAxjF7_U_wfkGfgbSlLDyWIq4Nsy"></div></center>
							</div>

							<div class="form-group">
								<input type="hidden" id="facebookId" value="" />
								<input type="hidden" id="facebookName" value="" />
								<input type="hidden" id="facebookEmail" value="" />
								<input type="hidden" id="facebookLink" value="" />
								<input type="submit" class="btn btn-primary btn-lg btn-block" id="btnIncluiDemanda" value="Solicitar" name="btnIncluiDemanda">
							</div>
						</div>
					</div>
				</div>
				
			<?php } ?>

            <footer class="footer">
                <p>Central de Informação | <a href="politica-privacidade.html" target="_blank">Política de Privacidade</a></p>
            </footer>

        </div>
    </form>
 
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/h5f.js"></script>
    <script type="text/javascript" src="js/bootstrap-validate.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>
	<script type="text/javascript" src="js/facebook-ouvidoria.js"></script>

</body>
</html>