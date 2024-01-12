<!doctype html>
<html lang="en" class="h-100">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title><?php echo APP_NAME?></title>

    <script src="././public/js/script.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sticky-footer-navbar/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>

    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <div class="container container_margem">
                <h1 class="nomempresa"><?= $m->designacaosocial?></h1>
                <h2 class="top-space"></h2>
                <div class="row">
                    <div class="col-sm-12">

                            <br>
                            <div class="boxer">
                                <div class="row"id="row1">
                                    <div class="col-3">
                                    <p type="text"> Cliente: <?= $fatura->user_cliente->username?><text>
                                    <p type="text"> Email: <?= $fatura->user_cliente->email?><text>
                                    <p type="text"> Nif: <?= $fatura->user_cliente->nif?><text>
                                    <p type="text"> data: <?= date('Y/m/d H:i:s', strtotime($fatura->data)); ?><text>
                                    <br>
                                    </div>
                                </div>
                            </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4>Lista de produtos</h4>
                                    </div>
                                    <div class="card-body">

                                        <table class="table tablestriped">
                                            <thead>
                                            <th class="text-center"><h4>Nome do produto</h4></th>
                                            <th class="text-center"><h4>Referencia</h4></th>
                                            <th class="text-center"><h4>Quantidade</h4></th>
                                            <th class="text-center"><h4>Valor Iva</h4></th>
                                            <th class="text-center"><h4>Valor</h4></th>
                                            </thead>
                                            <tbody>
                                            <?php if($linhasfatura != null){foreach ($linhasfatura as $linhafatura) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $linhafatura->produto->descricao ?></td>
                                                    <td class="text-center"><?= $linhafatura->produto->referencia ?></td>
                                                    <td class="text-center"><?= $linhafatura->quantidade ?></td>
                                                    <td class="text-center"><?= number_format($linhafatura->valoriva, 2); ?></td>
                                                    <td class="text-center"><?= number_format($linhafatura->valor, 2); ?></td>
                                                </tr>
                                            <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            <br>
                            <div class="boxer">
                                <div class="row end" id="row1">
                                    <div class="col-10 end-0">

                                    </div>
                                    <div class="col-1 end-0">
                                        <label for="ivatotal">Iva total:</label>
                                        <label for="ivatotal"><?php if(isset($fatura)) { echo number_format($fatura->ivatotal,2); }?>€</label>
                                        <br>
                                    </div>
                                    <div class="col-1 end-0">
                                        <label for="valortotal">Valor total:</label>
                                        <label for="valortotal" style="font-weight: bold; font-size: larger" ><?php if(isset($fatura)) { echo number_format($fatura->valortotal,2); }?>€</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="boxer">
                <div class="row end" id="row1">
                    <div class="col-8">
                    </div>
                    <div class="col-3 text-end">
                        <p type="text"> Nome do funcionario: <?= $fatura->user_empregado->username?><text>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
