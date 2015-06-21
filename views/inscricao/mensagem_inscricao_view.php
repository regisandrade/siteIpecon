<div id="pagina-interna">
    <div class="internaCtrl">
        <div class="titulo">&nbsp;</div>
        <div class="texto">
            <table width="100%" border="0" cellpadding="0" cellspacing="2">
                <tr>
                    <td><h2 align="center">Parabéns, sua pré-inscrição foi realizada com sucesso.</h2>
                    <p style="text-align: center;">Click no botão abaixo para gerar o boleto de pagamento da inscrição.</p>
                    <p style="text-align: center;"><br/>
                    <a data-toggle="modal" data-target="#webpageDialog" class="btn btn-warning btn-large" id="btnBoleto">GERAR BOLETO DA PRÉ-INSCRIÇÃO</a>
                    </td>
                </tr>
                <?php
                if($this->uri->segment(4) == 5){
                ?>
                <tr>
                    <td><br/><p style="text-align: center;">Garanta sua vaga efetuando o pagamento do boleto no valor de R$ 100,00 e enviando os seguintes documentos:</p>
                    <ul>
                        <li>Curriculum-Vitae simplificado; </li>
                        <li>Fotocópia do Diploma de Curso Superior; </li>
                        <li>Fotocópia da Carteira de Identidade; </li>
                        <li>Fotocópia do CPF; </li>
                        <li>Foto 3 x 4. </li>
                    </ul></td>
                </tr>
                <?php
                }else{
                ?>
                    <tr>
                        <td><br/><p style="text-align: center;">Garanta sua vaga efetuando o pagamento do boleto no valor de R$ 100,00.</p></td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <div id="webpageDialog" class="modal hide fade">
                <!--<div class="modal-header">
                    <a href="#" class="close" data-dismiss="modal">&times;</a>
                    <h3 id="prompt">Boleto da Pré-Inscrição</h3>
                </div>-->
                <div class="modal-body">
                    <iframe src="<?php echo base_url()?>public/util/boletophp/boleto_itau.php?idNumero=<?php echo $this->uri->segment(3) ?>&curso=<?php echo $this->uri->segment(4)?>" frameborder="0"></iframe>
                    </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" onclick="okWebpageDialog ()">OK</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>