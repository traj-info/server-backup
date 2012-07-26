<?php
/*
echo "<pre>";
print_r($resp);
echo "</pre>";
*/
?>

<?php
$q1[0] = (isset($resp['q1']) && $resp['q1'] == 0) ? 'checked' : '';
$q1[50] = (isset($resp['q1']) && $resp['q1'] == 50) ? 'checked' : '';
$q1[100] = (isset($resp['q1']) && $resp['q1'] == 100) ? 'checked' : '';
$q1[200] = (isset($resp['q1']) && $resp['q1'] == 200) ? 'checked' : '';
?>

<div class="question q_chefe_coordenador" id="q1uti">
<p class="question_header">1. Comprometimento com o funcionamento da UTI</p>
<input type="radio" name='q1' id='q1[0]' value='0' <?php echo $q1[0]; ?>><span>(0)</span> Passagem inadequada de plantões e/ou resolução inadquada das tarefas do plantão<br/>
<input type="radio" name='q1' id='q1[1]' value='50' <?php echo $q1[50]; ?>><span>(50)</span> Passagem adequada de plantão, mas sem resolução adequada das tarefas do plantão<br/>
<input type="radio" name='q1' id='q1[2]' value='100' <?php echo $q1[100]; ?>><span>(100)</span> Passagem adequada de plantões e resolução completa das tarefas do plantão<br/>
<input type="radio" name='q1' id='q1[3]' value='200' <?php echo $q1[200]; ?>><span>(200)</span> Alto comprometimento, com resolução dos conflitos da UTI e manutenção da rotatividade dos leitos
</div><!-- .question -->
<div class="clear"></div>

<?php
$q2[0] = (isset($resp['q2']) && $resp['q2'] == 0) ? 'checked' : '';
$q2[100] = (isset($resp['q2']) && $resp['q2'] == 100) ? 'checked' : '';
$q2[200] = (isset($resp['q2']) && $resp['q2'] == 200) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q2uti">
<p class="question_header">2. Presenteísmo / pontualidade</p>
<input type="radio" name='q2' id='q2[0]' value='0' <?php echo $q2[0]; ?>><span>(0)</span> Falta(s) injustificada(s) / 1 ou mais atrasos com comprometimento da assistência / mais de 2 atrasos / 2 ou mais regularizações de horário no mês<br/>
<input type="radio" name='q2' id='q2[1]' value='100' <?php echo $q2[100]; ?>><span>(100)</span> Até 2 atrasos por mês sem comprometimento da assistência / 1 regularização de horário no mês<br/>
<input type="radio" name='q2' id='q2[2]' value='200' <?php echo $q2[200]; ?>><span>(200)</span> Nenhum atrasos / nenhuma regularização de horário
</div><!-- .question -->
<div class="clear"></div>

<?php
$q3[0] = (isset($resp['q3']) && $resp['q3'] == 0) ? 'checked' : '';
$q3[50] = (isset($resp['q3']) && $resp['q3'] == 50) ? 'checked' : '';
$q3[100] = (isset($resp['q3']) && $resp['q3'] == 100) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q3uti">
<p class="question_header">3. Participação em atividades estratégicas da UTI-Anestesiologia</p>
<input type="radio" name='q3' id='q3[0]' value='0' <?php echo $q3[0]; ?>><span>(0)</span> Não participa de atividades estratégicas da UTI<br/>
<input type="radio" name='q3' id='q3[1]' value='50' <?php echo $q3[50]; ?>><span>(50)</span> Participa de pelo menos um grupo de atividade estratégica<br/>
<input type="radio" name='q3' id='q3[2]' value='100' <?php echo $q3[100]; ?>><span>(100)</span> Coordena pelo menos uma atividade estratégica da UTI<br/>
<div style="text-align: center;">ATIVIDADES ESTRATÉGICAS: Grupos de protocolos, Faturamento, Grupo de indicadores<br/>Grupo de pesquisa, Grupo de Acreditação, Grupo de educação continuada</div>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q4[0] = (isset($resp['q4']) && $resp['q4'] == 0) ? 'checked' : '';
$q4[50] = (isset($resp['q4']) && $resp['q4'] == 50) ? 'checked' : '';
$q4[100] = (isset($resp['q4']) && $resp['q4'] == 100) ? 'checked' : '';
?>
<div class="question" id="q4uti">
<p class="question_header">4. Presença em atividades de educação continuada da Disciplina de Anestesiologia</p>
<input type="radio" name='q4' id='q4[0]' value='0'> <?php echo $q4[0]; ?><span>(0)</span> Não participou de nenhuma atividade no mês anterior e não participou da reunião mensal da UTI<br/>
<input type="radio" name='q4' id='q4[1]' value='50' <?php echo $q4[50]; ?>><span>(50)</span> 1 (uma) atividade no mês anterior e/ou participação da reunião mensal da UTI<br/>
<input type="radio" name='q4' id='q4[2]' value='100' <?php echo $q4[100]; ?>><span>(100)</span> Mais de uma atividade no mês anterior, incluindo a participação da reunião mensal da UTI
</div><!-- .question -->
<div class="clear"></div>

<?php
$q5[0] = (isset($resp['q5']) && $resp['q5'] == 0) ? 'checked' : '';
$q5[25] = (isset($resp['q5']) && $resp['q5'] == 25) ? 'checked' : '';
$q5[50] = (isset($resp['q5']) && $resp['q5'] == 50) ? 'checked' : '';
$q5[100] = (isset($resp['q5']) && $resp['q5'] == 100) ? 'checked' : '';
?>
<div class="question" id="q5uti">
<p class="question_header">5. Colaboração com pesquisas da Disciplina de Anestesiologia</p>
<input type="radio" name='q5' id='q5[0]' value='0' <?php echo $q5[0]; ?>><span>(0)</span> Não tem envolvimento com atividades de pesquisa<br/>
<input type="radio" name='q5' id='q5[1]' value='25' <?php echo $q5[25]; ?>><span>(25)</span> Colabora na coleta de dados de pesquisa de outros assistentes, incluso a obtenção de TCLE<br/>
<input type="radio" name='q5' id='q5[2]' value='50' <?php echo $q5[50]; ?>><span>(50)</span> É pós-graduando e/ou autor de projeto de pesquisa clínica que se encontra em fase de coleta de dados<br/>
<input type="radio" name='q5' id='q5[3]' value='100' <?php echo $q5[100]; ?>><span>(100)</span> É autor de projeto de pesquisa clínica atual e teve pelo menos uma publicação (mínimo PUBMED) nos últimos 2 anos</radio>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q6[0] = (isset($resp['q6']) && $resp['q6'] == 0) ? 'checked' : '';
$q6[50] = (isset($resp['q6']) && $resp['q6'] == 50) ? 'checked' : '';
$q6[100] = (isset($resp['q6']) && $resp['q6'] == 100) ? 'checked' : '';
?>
<div class="question" id="q6uti">
<p class="question_header">6. Participação em atividades de ensino da Disciplina de Anestesiologia</p>
<input type="radio" name='q6' id='q6[0]' value='0' <?php echo $q6[0]; ?>><span>(0)</span> Não tem título de especialista em UTI e não participa das atividades de ensino a residentes e alunos<br/>
<input type="radio" name='q6' id='q6[1]' value='50' <?php echo $q6[50]; ?>><span>(50)</span> Não tem título de especialista em UTI mas participa das atividades práticas de ensino a residentes e alunos<br/>
<input type="radio" name='q6' id='q6[2]' value='100' <?php echo $q6[100]; ?>><span>(100)</span> Tem título de especialista em UTI e participa de atividades práticas e teóricas da UTI-anestesiologia
</div><!-- .question -->
<div class="clear"></div>

<?php
$q7[0] = (isset($resp['q7']) && $resp['q7'] == 0) ? 'checked' : '';
$q7[25] = (isset($resp['q7']) && $resp['q7'] == 25) ? 'checked' : '';
$q7[50] = (isset($resp['q7']) && $resp['q7'] == 50) ? 'checked' : '';
?>
<div class="question" id="q7uti">
<p class="question_header">7. Cumprimento das normas da C.C.I.H.</p>
<input type="radio" name='q7' id='q7[0]' value='0' <?php echo $q7[0]; ?>><span>(0)</span> Apresenta falhas reincidentes detectadas pela supervisão, enfermagem e/ou CCIH<br/>
<input type="radio" name='q7' id='q7[1]' value='25' <?php echo $q7[25]; ?>><span>(25)</span> Apresenta eventuais falhas detectadas pela supervisão, enfermagem e/ou CCIH<br/>
<input type="radio" name='q7' id='q7[2]' value='50' <?php echo $q7[50]; ?>><span>(50)</span> Cumpre plenamente as normas estabelecidas
</div><!-- .question -->
<div class="clear"></div>

<?php
$q8[0] = (isset($resp['q8']) && $resp['q8'] == 0) ? 'checked' : '';
$q8[25] = (isset($resp['q8']) && $resp['q8'] == 25) ? 'checked' : '';
$q8[50] = (isset($resp['q8']) && $resp['q8'] == 50) ? 'checked' : '';
?>
<div class="question" id="q8uti">
<p class="question_header">8. Adequação no preenchimento de documentos específicos</p>
<input type="radio" name='q8' id='q8[0]' value='0' <?php echo $q8[0]; ?>><span>(0)</span> Preenchimento inadequado e/ou incompleto da maioria dos documentos relacionados à atividade assistencial<br/>
<input type="radio" name='q8' id='q8[1]' value='25' <?php echo $q8[25]; ?>><span>(25)</span> Apresenta falhas eventuais no preenchimento dos documentos relacionados à atividade assistencial<br/>
<input type="radio" name='q8' id='q8[2]' value='50' <?php echo $q8[50]; ?>><span>(50)</span> Preenche de forma correta e completa todos os documentos relacionados à atividade assistencial
</div><!-- .question -->
<div class="clear"></div>

<?php
$q9[0] = (isset($resp['q9']) && $resp['q9'] == 0) ? 'checked' : '';
$q9[25] = (isset($resp['q9']) && $resp['q9'] == 25) ? 'checked' : '';
$q9[50] = (isset($resp['q9']) && $resp['q9'] == 50) ? 'checked' : '';
?>
<div class="question" id="q9uti">
<p class="question_header">9. Envolvimento em reclamações</p>
<input type="radio" name='q9' id='q9[0]' value='0' <?php echo $q9[0]; ?>><span>(0)</span> Envolvido em reclamações pertinentes encaminhadas à ouvidoria e/ou comissão de ética<br/>
<input type="radio" name='q9' id='q9[1]' value='25' <?php echo $q9[25]; ?>><span>(25)</span> Envolvido em reclamações pertinentes provenientes da equipe de cirurgia e/ou enfermagem<br/>
<input type="radio" name='q9' id='q9[2]' value='50' <?php echo $q9[50]; ?>><span>(50)</span> Ausência de reclamações
</div><!-- .question -->
<div class="clear"></div>

<?php
$q10[0] = (isset($resp['q10']) && $resp['q10'] == 0) ? 'checked' : '';
$q10[25] = (isset($resp['q10']) && $resp['q10'] == 25) ? 'checked' : '';
$q10[50] = (isset($resp['q10']) && $resp['q10'] == 50) ? 'checked' : '';
?>
<div class="question q_auto" id="q10uti">
<p class="question_header">10. Humanismo no cuidado ao paciente (Auto-avaliação)</p>
<input type="radio" name='q10' id='q10[0]' value='0' <?php echo $q10[0]; ?>><span>(0)</span> Considera que sua assistência não é compatível com tratamento humanizado<br/>
<input type="radio" name='q10' id='q10[1]' value='25' <?php echo $q10[25]; ?>><span>(25)</span> Considera que sua assistência está de acordo com as expctativas institucionais em relação ao tratamento humanizado<br/>
<input type="radio" name='q10' id='q10[2]' value='50' <?php echo $q10[50]; ?>><span>(50)</span> Considera que sua assistência supera as expectativas institucionais em relação ao tratamento humanizado
</div><!-- .question -->
<div class="clear"></div>
