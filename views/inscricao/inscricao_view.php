<div id="pagina-interna">
     <div class="internaCtrl">
          <div class="titulo">Pré-Inscrição</div>
          <div class="texto">
               <?php
               if (!isset($this->uri->segments[3])) {
                    echo "<div class=\"alert alert-error fade in erroPreInscricao\">
                    <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button><strong>Atenção</strong><br>Selecionar um curso antes de realizar a pré-inscrição.</div>";
               }
               if (isset($this->uri->segments[4])) {
                    switch ($this->uri->segments[4]) {
                         case '1':
                              $frase = 'Você já esta cadastrado neste curso.';
                              break;
                         case '2':
                              $frase = 'Você já tem Endereço cadastrado.';
                              break;
                         case '3':
                              $frase = 'Erro no envio de e-mail do boleto.';
                              break;
                         case '4':
                              $frase = 'Erro no envio de e-mail dos dados da pré-inscrição.';
                              break;
                         case '4':
                              $frase = 'Erro no envio de e-mail de aviso ao IPECON.';
                              break;
                    }
                    echo "<div class=\"alert alert-error fade in erroPreInscricao \">
                    <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button><strong>Atenção</strong><br>".$frase."</div>";
               }
               ?>
               <form class="form-horizontal" name="formInscricao" id="formInscricao" action="<?php echo base_url('index.php').'/inscricao/gravarPreInscricao'?>" method="POST">
                    <fieldset>
                         <div class="control-group">
                              <label class="control-label"><strong>Curso:</strong></label>
                              <div class="controls">
                                   <select name="codg_curso" id="codg_curso" class="input-xlarge">
                                        <option value="">[-- Selecionar --]</option>
                                        <?php                               
                                        foreach ($cursos as $curso) { ?>
                                             <option value="<?php echo $curso->Codg_Curso; ?>" <?php echo ($this->uri->segment(3) == $curso->Codg_Curso ? 'selected="true"' : ""); ?>><?php echo $curso->Nome; ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                         </div>

                         <!--<div class="control-group">
                              <label class="control-label"><strong>Cidade do Curso:</strong></label>
                              <div class="controls">
                                   <select name="cidadeCurso" id="cidadeCurso">
                                        <option value="" selected>[-- Selecionar --]</option>
                                        <option value="Anápolis">Anápolis</option>
                                        <option value="Ceres">Ceres</option>
                                        <option value="Cidade de Goiás">Cidade de Goiás</option>
                                        <option value="Goiânia">Goiânia</option>
                                        <option value="Itumbiara">Itumbiara</option>
                                        <option value="Pires do Rio">Pires do Rio</option>
                                        <option value="Porangatu">Porangatu</option>
                                        <option value="Rio Verde">Rio Verde</option>
                                        <option value="Trindade">Trindade</option>
                                        <option value="Uruaçu">Uruaçu</option>
                                   </select>
                              </div>
                         </div>-->

                         <div class="control-group">
                              <label class="control-label"><strong>Ano do Curso:</strong></label>
                              <div class="controls">
                                   <select name="ano" id="ano" class="input-small">
                                   <?php
                                   for($i = 2003; $i <= date('Y')+1; $i++){
                                   ?>
                                        <option value="<?=$i; ?>" <?php if($i == date('Y')){ echo 'selected'; }?>><?=$i; ?></option>
                                   <?php
                                   }
                                   ?>
                                   </select>
                              </div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Nome:</strong></label>
                              <div class="controls"><input name="nome" type="text" id="nome" class="input-xxlarge"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Data de nascimento:</strong></label>
                              <div class="controls"><input name="data_nascimento" type="text" id="data_nascimento" class="input-small" /></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Naturalidade:</strong></label>
                              <div class="controls"><input name="naturalidade" type="text" id="naturalidade" class="input-large"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Estado:</strong></label>
                              <div class="controls">
                                   <select name="uf_1" class="input-small">
                                        <option value="">UF</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO" selected>GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MG">MG</option>
                                        <option value="MS">MS</option>
                                        <option value="MT">MT</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="PR">PR</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="RS">RS</option>
                                        <option value="SC">SC</option>
                                        <option value="SE">SE</option>
                                        <option value="SP">SP</option>
                                        <option value="TO">TO</option>
                                   </select>
                              </div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Nacionalidade:</strong></label>
                              <div class="controls"><input name="nacionalidade" type="text" id="nacionalidade" value="Brasileira" class="input-large"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Sexo:</strong></label>
                              <div class="controls"><input name="sexo" type="radio" value="M" checked>M&nbsp;&nbsp;&nbsp;<input type="radio" name="sexo" value="F">F</div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Identidade (RG):</strong></label>
                              <div class="controls"><input name="rg" type="text" id="rg" class="input-large"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Órgão Exp.:</strong></label>
                              <div class="controls"><input name="orgao" type="text" id="orgao" class="input-small"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Nº C.P.F.:</strong></label>
                              <div class="controls"><input name="cpf" id="cpf" type="text" class="input-medium"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Endereço:</strong></label>
                              <div class="controls"><input name="endereco" id="endereco" type="text" class="input-xxlarge"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Bairro:</strong></label>
                              <div class="controls"><input name="bairro" type="text" id="bairro" class="input-large"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Cidade:</strong></label>
                              <div class="controls"><input name="cidade" type="text" id="cidade" class="input-large"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Estado:</strong></label>
                              <div class="controls">
                                   <select name="uf_2" class="input-small">
                                        <option value="">UF</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO" selected>GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MG">MG</option>
                                        <option value="MS">MS</option>
                                        <option value="MT">MT</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="PR">PR</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="RS">RS</option>
                                        <option value="SC">SC</option>
                                        <option value="SE">SE</option>
                                        <option value="SP">SP</option>
                                        <option value="TO">TO</option>
                                   </select>
                              </div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>CEP:</strong></label>
                              <div class="controls"><input name="cep" type="text" id="cep" class="input-small"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong><u>Telefones</u></strong></label>
                              <div class="controls">&nbsp;</div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Residêncial:</strong></label>
                              <div class="controls"><input name="fone_residencial" type="text" id="fone_residencial" class="input-medium"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Celular:</strong></label>
                              <div class="controls"><input name="celular" type="text" id="celular" class="input-medium"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Comercial:</strong></label>
                              <div class="controls"><input name="fone_comercial" type="text" id="fone_comercial" class="input-medium"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>e-Mail:</strong></label>
                              <div class="controls"><input name="email" type="text" id="email" class="input-xlarge"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Curso de Graduação:</strong></label>
                              <div class="controls"><input name="curso" type="text" id="curso" class="input-xlarge"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Instituição:</strong></label>
                              <div class="controls"><input name="instituicao" type="text" id="instituicao" class="input-xlarge"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Sigla da instituição:</strong></label>
                              <div class="controls"><input name="sigla" type="text" id="sigla" class="input-small"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Conclusão:</strong></label>
                              <div class="controls"><input name="conclusao" type="text" id="conclusao" class="input-small"></div>
                         </div>

                         <div class="control-group">
                              <label class="control-label"><strong>Como ficou sabendo:</strong></label>
                              <div class="controls">
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="1" />&nbsp;Mala direta (CORREIOS)<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="2" />&nbsp;Outdoor<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="3" />&nbsp;E-mail Marketing (newsletter)<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="4" />&nbsp;Folder (material impresso)<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="5" />&nbsp;Eventos (palestras, etc.)<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="6" />&nbsp;Indicação de ex alunos<br/>
                                   <input type="radio" name="ficouSabendo" id="ficouSabendo" value="7" />&nbsp;Outros
                              </div>
                         </div>

                         <div class="control-group">
                              <label class="control-label">&nbsp;</label>
                              <div class="controls"><button type="submit" name="ok" id="ok" class="btn btn-large btn-primary">Enviar</button></div>
                         </div>
                    </fieldset>
               </form>
          </div>
     </div>
</div>