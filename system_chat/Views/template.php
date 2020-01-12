<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type ="text/css" href="<?php echo BASE?>assets/css/template.css">
    <title>EAD_GV</title>
</head>
<body>
    <?php $this->loadViewInTemplate($name,$dados)?>
    <div class="modal" style=display:none;>
        <div class='modal_area'>
            ...
        </div>
    </div>
    <script type="text/javascript">
        var BASE='<?php echo BASE?>'
        var BASE_PRINCIPAL='<?php echo BASE_PRINCIPAL?>'
        var lista_grupo=<?php echo json_encode($dados['grupos_atuais'])?>
    </script>
    <script type="text/javascript" src="<?php echo BASE?>assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE?>assets/js/chat_ead.js"></script>
    <script type="text/javascript" src="<?php echo BASE?>assets/js/script.js"></script>
</body>
</html>