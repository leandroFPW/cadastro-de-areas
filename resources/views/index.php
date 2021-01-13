<!DOCTYPE html>
<html>
    <head>
        <title>Avaliação</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" async></script>
        <script type="text/javascript">
            var BASE_URL = '<?php echo url('/');?>/';
            /*somente numeros decimais*/
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31
                        && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
            /*usando ajax*/
            function postR(){
                $('#resp').html('Enviando...');
                $.post(BASE_URL+'area-retangulo',
                    {'base':$('#in_base').val(),'altura':$('#in_altura').val()},
                    function(resp){
                        if(resp.area.length){
                            $('#resp').html('Retângulo salvo com área = '+resp.area);
                        }else{
                            $('#resp').html('Erro: '+resp.retorno);
                        }
                    });
            }
            function postT(){
                $('#resp').html('Enviando...');
                $.post(BASE_URL+'area-triangulo',
                    {'base':$('#in_base').val(),'altura':$('#in_altura').val()},
                    function(resp){
                        if(resp.area.length){
                            $('#resp').html('Triângulo salvo com área = '+resp.area);
                        }else{
                            $('#resp').html('Erro: '+resp.retorno);
                        }
                    });
            }
            function getTotal(){
                $('#resp').html('Buscando...');
                $.get(BASE_URL+'areas',function(resp){
                    if(resp.total.length){
                        $('#resp').html('Área total dos polígonos = '+resp.total);
                    }else{
                        $('#resp').html('Não foi possível listar');
                    }
                });
            }
        </script>
        <style type="text/css">
            body{font-family: arial, sans-serif;}
            button{display: block;margin: 10px 0;}
        </style>
    </head>
    <body>
        <ol>
            <li>Rota que permita cadastrar retângulos: <?php echo url('area-retangulo'); ?> [post]</li>
            <li>Rota que permita cadastrar triângulos: <?php echo url('area-triangulo'); ?> [post]</li>
            <li>Rota que retorne o valor da soma das áreas de todos os polígonos cadastrados: <?php echo url('areas'); ?> [get]</li>
        </ol>
        <p>Formulário para testes (considerando área dos polígonos apenas com Base e Altura):</p>
        <table>
            <tr>
                <td>Base:</td>
                <td><input id="in_base" type="text" onkeypress="return isNumberKey(event)"/></td>
            </tr>
            <tr>
                <td>Altura:</td>
                <td><input id="in_altura" type="text" onkeypress="return isNumberKey(event)"/></td>
            </tr>
        </table>
        <button type="button" onclick="postR();">Cadastrar como Retângulo</button>
        <button type="button" onclick="postT();">Cadastrar como Triângulo</button>
        <button type="button" onclick="getTotal();">Buscar totais</button>
        <p id="resp"></p>
    </body>
</html>
