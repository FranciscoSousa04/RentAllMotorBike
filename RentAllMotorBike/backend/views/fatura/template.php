<?php 
  //calculo do nr de dias do aluguer
  $dataIni = date_create($model->detalhesAluguerFatura->data_inicio);
  $dataFim = date_create($model->detalhesAluguerFatura->data_fim);
  $dataDiff = date_diff($dataIni, $dataFim);
  $nrDias = (int)$dataDiff->format("%a");
  $nrDias++;

  //var_dump($model->detalhesAluguerFatura->profile->nome);
  
  //die;
?>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

<body>

  <table width="100%">
    <tr>
        <!--<td valign="top"><img src="././img/logo.jpg" width="150"/> </td>-->
        <td valign="top"><img src="https://cdn.discordapp.com/attachments/775382256151035936/1061798574788194324/logo.png" width="150"/> </td>
        <td align="right">
            <h3>rentallmotorbike</h3>
            <pre>
                rentallmotorbike
                Email: rentallmotorbike@gmail.com
                Contacto: +351 962 234 518
                Morada: Avenida Marquês de Pombal, Leiria

            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>From:</strong> rentallmotorbike</td>
        <td><strong>To:</strong> <?= $model->detalhesAluguerFatura->profile->nome . ' ' . $model->detalhesAluguerFatura->profile->apelido ?></td>
    </tr>
  </table>

  <br/>
  
  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>Descricao</th>
        <th>Preco por dia €</th>
        <th>Total €</th>
      </tr>
    </thead>

    <tbody>
      <?php

          foreach ($model->linhaFaturas as $linhaFat) {
              if ( $linhaFat->preco!= 0){?>
            <tr>
              <td><?= $linhaFat->descricao ?></td>
              <td align="right"><?= $linhaFat->preco ?></td>
              <td align="right"><?= $linhaFat->preco*$nrDias ?></td>
            </tr>
          <?php } }?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="right">Total €</td>
            <td align="right" class="gray"><?= $model->preco_total ?></td>
        </tr>
    </tfoot>
  </table>

</body>
