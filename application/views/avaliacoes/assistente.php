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

<div class="question q_chefe_coordenador" id="q1assistente">
<p class="question_header">1a. Cumprimento da produtividade acordada como anestesiologista clínico</p>
<input type="radio" name='q1' id='q1[0]' value='0' <?php echo $q1[0]; ?>><span>(0)</span> Relação entre produção assistencial e o tempo de trabalho disponível inferior a 20%<br/>
<input type="radio" name='q1' id='q1[1]' value='50' <?php echo $q1[50]; ?>><span>(50)</span> Relação entre produção assistencial e o tempo de trabalho disponível entre 21 e 49%<br/>
<input type="radio" name='q1' id='q1[2]' value='100' <?php echo $q1[100]; ?>><span>(100)</span> Relação entre produção assistencial e o tempo de trabalho disponível entre 50 e 74%<br/>
<input type="radio" name='q1' id='q1[3]' value='200' <?php echo $q1[200]; ?>><span>(200)</span> Relação entre produção assistencial e o tempo de trabalho disponível igual ou superior a 75%
</div><!-- .question -->
<div class="clear"></div>

<?php
$q2[0] = (isset($resp['q2']) && $resp['q2'] == 0) ? 'checked' : '';
$q2[50] = (isset($resp['q2']) && $resp['q2'] == 50) ? 'checked' : '';
$q2[100] = (isset($resp['q2']) && $resp['q2'] == 100) ? 'checked' : '';
$q2[200] = (isset($resp['q2']) && $resp['q2'] == 200) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q2assistente">
<p class="question_header">1b. Cumprimento da produtividade acordada para médicos do ambulatório de dor / interconsulta dor</p>
<input type="radio" name='q2' id='q2[0]' value='0'> <?php echo $q2[0]; ?><span>(0)</span> Número médio de consultas inferior a 1,0 atendimento/hora trabalhada<br/>
<input type="radio" name='q2' id='q2[1]' value='50' <?php echo $q2[50]; ?>><span>(50)</span> Número médio de consultas entre 1,1 e 1,5 atendimentos/hora trabalhada<br/>
<input type="radio" name='q2' id='q2[2]' value='100' <?php echo $q2[100]; ?>><span>(100)</span> Número médio de consultas entre 1,6 e 1,9 atendimentos/hora trabalhada<br/>
<input type="radio" name='q2' id='q2[3]' value='200' <?php echo $q2[200]; ?>><span>(200)</span> Número médio de consultas igual ou superior a 2,0 atendimentos/hora trabalhada</radio>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q3[0] = (isset($resp['q3']) && $resp['q3'] == 0) ? 'checked' : '';
$q3[50] = (isset($resp['q3']) && $resp['q3'] == 50) ? 'checked' : '';
$q3[100] = (isset($resp['q3']) && $resp['q3'] == 100) ? 'checked' : '';
$q3[200] = (isset($resp['q3']) && $resp['q3'] == 200) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q3assistente">
<p class="question_header">1c. Cumprimento da produtividade acordada para médicos do ambulatório pré-operatório / VPA</p>
<input type="radio" name='q3' id='q3[0]' value='0' <?php echo $q3[0]; ?>><span>(0)</span> Número médio de consultas inferior a 1,0 atendimento/hora trabalhada<br/>
<input type="radio" name='q3' id='q3[1]' value='50' <?php echo $q3[50]; ?>><span>(50)</span> Número médio de consultas entre 1,1 e 2,0 atendimentos/hora trabalhada<br/>
<input type="radio" name='q3' id='q3[2]' value='100' <?php echo $q3[100]; ?>><span>(100)</span> Número médio de consultas entre 2,1 e 3,0 atendimentos/hora trabalhada<br/>
<input type="radio" name='q3' id='q3[3]' value='200' <?php echo $q3[200]; ?>><span>(200)</span> Número médio de consultas igual ou superior a 3,0 atendimentos/hora trabalhada</radio></div><!-- .question -->
<div class="clear"></div>

<?php
$q4[0] = (isset($resp['q4']) && $resp['q4'] == 0) ? 'checked' : '';
$q4[100] = (isset($resp['q4']) && $resp['q4'] == 100) ? 'checked' : '';
$q4[200] = (isset($resp['q4']) && $resp['q4'] == 200) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q4">
<p class="question_header">2. Presenteísmo / pontualidade</p>
<input type="radio" name='q4' id='q4[0]' value='0' <?php echo $q4[0]; ?>><span>(0)</span> Falta(s) injustificada(s) / 1 ou mais atrasos com comprometimento da assistência / mais de 2 atrasos / 2 ou mais regularizações de horário no mês<br/>
<input type="radio" name='q4' id='q4[1]' value='100' <?php echo $q4[100]; ?>><span>(100)</span> Até 2 atrasos por mês sem comprometimento da assistência / 1 regularização de horário no mês<br/>
<input type="radio" name='q4' id='q4[2]' value='200' <?php echo $q4[200]; ?>><span>(200)</span> Nenhum atrasos / nenhuma regularização de horário
</div><!-- .question -->
<div class="clear"></div>

<?php
$q5[0] = (isset($resp['q5']) && $resp['q5'] == 0) ? 'checked' : '';
$q5[50] = (isset($resp['q5']) && $resp['q5'] == 50) ? 'checked' : '';
$q5[100] = (isset($resp['q5']) && $resp['q5'] == 100) ? 'checked' : '';
?>
<div class="question" id="q5assistente">
<p class="question_header">3. Participação em plantões e cirurgias estratégicas da Divisão de Anestesia</p>
<input type="radio" name='q5' id='q5[0]' value='0'> <?php echo $q5[0]; ?><span>(0)</span> Não participa de plantões e/ou cirurgias estratégicas<br/>
<input type="radio" name='q5' id='q5[1]' value='50' <?php echo $q5[50]; ?>><span>(50)</span> Participa com até 1 plantão em PS/Obst/Dor e/ou cirurgias estratégicas por semana<br/>
<input type="radio" name='q5' id='q5[2]' value='100' <?php echo $q5[100]; ?>><span>(100)</span> Participa de plantões de UTI ou de anestesias para transplante de órgãos
<div style="text-align: center;">CIRURGIAS ESTRATÉGICAS: Transplante de órgãos, cirurgias de longa duração (>12hs), neurocirurgia, grandes cirurgias de tórax e grandes cirurgias vasculares, grandes cirurgias pediátricas, anestesia em queimados</div>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q6[0] = (isset($resp['q6'][0]) && $resp['q6'][0] == 20) ? 'checked' : '';
$q6[1] = (isset($resp['q6'][1]) && $resp['q6'][1] == 20) ? 'checked' : '';
$q6[2] = (isset($resp['q6'][2]) && $resp['q6'][2] == 20) ? 'checked' : '';
$q6[3] = (isset($resp['q6'][3]) && $resp['q6'][3] == 10) ? 'checked' : '';
$q6[4] = (isset($resp['q6'][4]) && $resp['q6'][4] == 10) ? 'checked' : '';
$q6[5] = (isset($resp['q6'][5]) && $resp['q6'][5] == 10) ? 'checked' : '';
$q6[6] = (isset($resp['q6'][6]) && $resp['q6'][6] == 10) ? 'checked' : '';

?>
<div class="question" id="q6assistente">
<p class="question_header">4. Participação em atividades de educação continuada (soma dos itens)</p>
<input type="checkbox" name='q6[0]' id='q6[0]' value='20' <?php echo $q6[0]; ?>><span>(20)</span> Aprovado em ACLS nos últimos 5 anos<br/>
<input type="checkbox" name='q6[1]' id='q6[1]' value='20' <?php echo $q6[1]; ?>><span>(20)</span> Participou de treinamento da Disciplina sobre ressuscitação nos últimos 2 anos<br/>
<input type="checkbox" name='q6[2]' id='q6[2]' value='20' <?php echo $q6[2]; ?>><span>(20)</span> Participou de treinamento da Disciplina sobre via aérea difícil nos últimos 5 anos<br/>
<input type="checkbox" name='q6[3]' id='q6[3]' value='10' <?php echo $q6[3]; ?>><span>(10)</span> Participou do grupo de discussão de sua equipe no último mês<br/>
<input type="checkbox" name='q6[4]' id='q6[4]' value='10' <?php echo $q6[4]; ?>><span>(10)</span> Participou de uma atividade didática da Disciplina no último mês<br/>
<input type="checkbox" name='q6[5]' id='q6[5]' value='10' <?php echo $q6[5]; ?>><span>(10)</span> Participou de mais de uma atividade didática da Disciplina no último mês<br/>
<input type="checkbox" name='q6[6]' id='q6[6]' value='10' <?php echo $q6[6]; ?>><span>(10)</span> Participou de congressos/jornadas/workshops fora da instituição no último mês<br/>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q7[0] = (isset($resp['q7']) && $resp['q7'] == 0) ? 'checked' : '';
$q7[25] = (isset($resp['q7']) && $resp['q7'] == 25) ? 'checked' : '';
$q7[50] = (isset($resp['q7']) && $resp['q7'] == 50) ? 'checked' : '';
$q7[100] = (isset($resp['q7']) && $resp['q7'] == 100) ? 'checked' : '';
$text_q7[0] = (isset($resp['text_q7'][0])) ? $resp['text_q7'][0] : '';
$text_q7[1] = (isset($resp['text_q7'][1])) ? $resp['text_q7'][1] : '';
$text_q7[2] = (isset($resp['text_q7'][2])) ? $resp['text_q7'][2] : '';
?>
<div class="question" id="q7assistente">
<p class="question_header">5. Colaboração com pesquisas da Disciplina de Anestesiologia (com comprovação)</p>
<input type="radio" name='q7' id='q7[0]' value='0' <?php echo $q7[0]; ?>><span>(0)</span> Não tem envolvimento com atividades de pesquisa<br/>
<input type="radio" name='q7' id='q7[1]' value='25' <?php echo $q7[25]; ?>><span>(25)</span> Participa da coleta de dados de protocolos de pesquisa de outros assistentes ou residentes<br/>
<div style="margin-left: 40px; ">Citar projeto(s): <input type="text" name="text_q7[0]" id="text_q7[0]" value="<?php echo $text_q7[0]; ?>"/></div><br/>
<input type="radio" name='q7' id='q7[2]' value='50' <?php echo $q7[50]; ?>><span>(50)</span> Participa da aplicação de TCLE e da coleta de dados de protocolos de pesquisa de outros assistentes ou residentes<br/>
<div style="margin-left: 40px; ">Citar projeto(s): <input type="text" name="text_q7[1]" id="text_q7[1]" value="<?php echo $text_q7[1]; ?>"/></div><br/>
<input type="radio" name='q7' id='q7[3]' value='100' <?php echo $q7[100]; ?>><span>(100)</span> É autor de projeto de pesquisa que se encontra em fase de coleta de dados no local de trabalho do assistente<br/>
<div style="margin-left: 40px; ">Citar projeto(s): <input type="text" name="text_q7[2]" id="text_q7[2]" value="<?php echo $text_q7[2]; ?>"/></div>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q8[0] = (isset($resp['q8']) && $resp['q8'] == 0) ? 'checked' : '';
$q8[25] = (isset($resp['q8']) && $resp['q8'] == 25) ? 'checked' : '';
$q8[50] = (isset($resp['q8']) && $resp['q8'] == 50) ? 'checked' : '';
$q8[100] = (isset($resp['q8']) && $resp['q8'] == 100) ? 'checked' : '';
?>
<div class="question" id="q8assistente">
<p class="question_header">6. Participação em atividades de ensino da Disciplina de Anestesiologia</p>
<input type="radio" name='q8' id='q8[0]' value='0' <?php echo $q8[0]; ?>><span>(0)</span> Não participa de atividades de ensino da Disciplina de Anestesiologia<br/>
<input type="radio" name='q8' id='q8[1]' value='25' <?php echo $q8[25]; ?>><span>(25)</span> Participa das atividades práticas do Programa de Residência Médica ou Graduação<br/>
<input type="radio" name='q8' id='q8[2]' value='50' <?php echo $q8[50]; ?>><span>(50)</span> Participa das atividades práticas e teóricas do Programa de Residência Médica ou Graduação<br/>
<input type="radio" name='q8' id='q8[3]' value='100' <?php echo $q8[100]; ?>><span>(100)</span> Participa das atividades práticas e teóricas do Programa de Residência Médica ou Graduação e é instrutor/corresponsável do CET-HC<br/>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q9[0] = (isset($resp['q9']) && $resp['q9'] == 0) ? 'checked' : '';
$q9[25] = (isset($resp['q9']) && $resp['q9'] == 25) ? 'checked' : '';
$q9[50] = (isset($resp['q9']) && $resp['q9'] == 50) ? 'checked' : '';
?>
<div class="question" id="q9assistente">
<p class="question_header">7. Cumprimento das normas da C.C.I.H.</p>
<input type="radio" name='q9' id='q9[0]' value='0' <?php echo $q9[0]; ?>><span>(0)</span> Apresenta falhas reincidentes detectadas pela supervisão, enfermagem e/ou CCIH<br/>
<input type="radio" name='q9' id='q9[1]' value='25' <?php echo $q9[25]; ?>><span>(25)</span> Apresenta eventuais falhas detectadas pela supervisão, enfermagem e/ou CCIH<br/>
<input type="radio" name='q9' id='q9[2]' value='50' <?php echo $q9[50]; ?>><span>(50)</span> Cumpre plenamente as normas estabelecidas
</div><!-- .question -->
<div class="clear"></div>

<?php
$q10[0] = (isset($resp['q10']) && $resp['q10'] == 0) ? 'checked' : '';
$q10[25] = (isset($resp['q10']) && $resp['q10'] == 25) ? 'checked' : '';
$q10[50] = (isset($resp['q10']) && $resp['q10'] == 50) ? 'checked' : '';
?>
<div class="question" id="q10assistente">
<p class="question_header">8. Adequação no preenchimento de documentos específicos</p>
<input type="radio" name='q10' id='q10[0]' value='0' <?php echo $q10[0]; ?>><span>(0)</span> Preenchimento inadequado e/ou incompleto da maioria dos documentos relacionados à atividade assistencial<br/>
<input type="radio" name='q10' id='q10[1]' value='25' <?php echo $q10[25]; ?>><span>(25)</span> Apresenta falhas eventuais no preenchimento dos documentos relacionados à atividade assistencial<br/>
<input type="radio" name='q10' id='q10[2]' value='50' <?php echo $q10[50]; ?>><span>(50)</span> Preenche de forma correta e completa todos os documentos relacionados à atividade assistencial
</div><!-- .question -->
<div class="clear"></div>

<?php
$q11[0] = (isset($resp['q11']) && $resp['q11'] == 0) ? 'checked' : '';
$q11[25] = (isset($resp['q11']) && $resp['q11'] == 25) ? 'checked' : '';
$q11[50] = (isset($resp['q11']) && $resp['q11'] == 50) ? 'checked' : '';
?>
<div class="question" id="q11assistente">
<p class="question_header">9. Envolvimento em reclamações</p>
<input type="radio" name='q11' id='q11[0]' value='0' <?php echo $q11[0]; ?>><span>(0)</span> Envolvido em reclamações pertinentes encaminhadas à ouvidoria e/ou comissão de ética<br/>
<input type="radio" name='q11' id='q11[1]' value='25' <?php echo $q11[25]; ?>><span>(25)</span> Envolvido em reclamações pertinentes provenientes da equipe de cirurgia e/ou enfermagem<br/>
<input type="radio" name='q11' id='q11[2]' value='50' <?php echo $q11[50]; ?>><span>(50)</span> Ausência de reclamações
</div><!-- .question -->
<div class="clear"></div>

<?php
$q12[0] = (isset($resp['q12']) && $resp['q12'] == 0) ? 'checked' : '';
$q12[25] = (isset($resp['q12']) && $resp['q12'] == 25) ? 'checked' : '';
$q12[50] = (isset($resp['q12']) && $resp['q12'] == 50) ? 'checked' : '';
?>
<div class="question q_auto" id="q12assistente">
<p class="question_header">10. Humanismo no cuidado ao paciente (Auto-avaliação)</p>
<input type="radio" name='q12' id='q12[0]' value='0' <?php echo $q12[0]; ?>><span>(0)</span> Considera que sua assistência não é compatível com tratamento humanizado<br/>
<input type="radio" name='q12' id='q12[1]' value='25' <?php echo $q12[25]; ?>><span>(25)</span> Considera que sua assistência está de acordo com as expctativas institucionais em relação ao tratamento humanizado<br/>
<input type="radio" name='q12' id='q12[2]' value='50' <?php echo $q12[50]; ?>><span>(50)</span> Considera que sua assistência supera as expectativas institucionais em relação ao tratamento humanizado
</div><!-- .question -->
<div class="clear"></div>
