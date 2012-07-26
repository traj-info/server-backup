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
$q1[150] = (isset($resp['q1']) && $resp['q1'] == 150) ? 'checked' : '';
$q1[200] = (isset($resp['q1']) && $resp['q1'] == 200) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q1superv_coord">
<p class="question_header">1. Controle da assiduidade e produtividade assistencial</p>
<input type="radio" name='q1' id='q1[0]' value='0' <?php echo $q1[0]; ?>><span>(0)</span> O sup./coord. e/ou a equipe supervisionada não cumprem a carga horária e as atividades assistenciais pré-estabelecidas<br/>
<input type="radio" name='q1' id='q1[1]' value='50' <?php echo $q1[50]; ?>><span>(50)</span> O sup./coord. cumpre a carga horária própria mas não se empenha na assiduidade e produtividade assistencial da equipe<br/>
<input type="radio" name='q1' id='q1[2]' value='100' <?php echo $q1[100]; ?>><span>(100)</span> O sup./coord. e a totalidade da equipe liderada são assíduos, pontuais e cumprem as metas assistenciais<br/>
<input type="radio" name='q1' id='q1[3]' value='150' <?php echo $q1[150]; ?>><span>(150)</span> O sup./coord. comparece diariamente 6 ou + horas à instituição (2a. a 6a. F) e se empenha na assiduidade e produtividade assistencial da equipe<br/>
<input type="radio" name='q1' id='q1[4]' value='200' <?php echo $q1[200]; ?>><span>(200)</span> O sup./coord. comparece diariamente 6 ou + horas à instituição (2a. a 6a. F) e os liderados são assíduos e cumprem a produtividade assistencial prevista
</div><!-- .question -->
<div class="clear"></div>

<?php
$q2[0] = (isset($resp['q2']) && $resp['q2'] == 0) ? 'checked' : '';
$q2[50] = (isset($resp['q2']) && $resp['q2'] == 50) ? 'checked' : '';
$q2[100] = (isset($resp['q2']) && $resp['q2'] == 100) ? 'checked' : '';
$q2[150] = (isset($resp['q2']) && $resp['q2'] == 150) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q2superv_coord">
<p class="question_header">2. Gerência da qualidade e segurança assistencial</p>
<input type="radio" name='q2' id='q2[0]' value='0' <?php echo $q2[0]; ?>><span>(0)</span> Os P.O.P.s da equipe não estão divulgados ou não foram atualizados nos últimos 2 anos<br/>
<input type="radio" name='q2' id='q2[1]' value='50' <?php echo $q2[50]; ?>><span>(50)</span> Os P.O.P.s da equipe estão divulgados mas a maioria da equipe não segue os protocolos de conduta assistenciais<br/>
<input type="radio" name='q2' id='q2[2]' value='100' <?php echo $q2[100]; ?>><span>(100)</span> Os P.O.P.s da equipe estão divulgados e são seguidos, mas não são utilizados indicadores de qualidade e segurança<br/>
<input type="radio" name='q2' id='q2[3]' value='150' <?php echo $q2[150]; ?>><span>(150)</span> A equipe segue os P.O.P.s e são divulgados regularmente os indicadores de qualidade e segurança
</div><!-- .question -->
<div class="clear"></div>

<?php
$q3[0] = (isset($resp['q3']) && $resp['q3'] == 0) ? 'checked' : '';
$q3[50] = (isset($resp['q3']) && $resp['q3'] == 50) ? 'checked' : '';
$q3[100] = (isset($resp['q3']) && $resp['q3'] == 100) ? 'checked' : '';
?>
<div class="question q_chefe_coordenador" id="q3superv_coord">
<p class="question_header">3. Atendimento aos clientes (equipes cirúrgicas e pacientes)</p>
<input type="radio" name='q3' id='q3[0]' value='0' <?php echo $q3[0]; ?>><span>(0)</span> As necessidades dos clientes da equipe não estão claramente definidas no planejamento estratégico<br/>
<input type="radio" name='q3' id='q3[1]' value='50' <?php echo $q3[50]; ?>><span>(50)</span> As necessidades dos clientes são consideradas mas há sinais de insatisfação de parte dos clientes atendidos pela equipe<br/>
<input type="radio" name='q3' id='q3[2]' value='100' <?php echo $q3[100]; ?>><span>(100)</span> Os clientes atendidos expressam completa satisfação pelo atendimento recebido
</div><!-- .question -->
<div class="clear"></div>

<?php
$q4[0] = (isset($resp['q4']) && $resp['q4'] == 0) ? 'checked' : '';
$q4[50] = (isset($resp['q4']) && $resp['q4'] == 50) ? 'checked' : '';
$q4[100] = (isset($resp['q4']) && $resp['q4'] == 100) ? 'checked' : '';
?>
<div class="question" id="q4superv_coord">
<p class="question_header">4. Atividades de educação continuada / atualização técnica</p>
<input type="radio" name='q4' id='q4[0]' value='0' <?php echo $q4[0]; ?>><span>(0)</span> O supervisor/coordenador e a equipe não participam de atividades de educação continuada ou atualização técnica<br/>
<input type="radio" name='q4' id='q4[1]' value='50' <?php echo $q4[50]; ?>><span>(50)</span> O supervisor/coordenador estimula a equipe para atividades de educação continuada e atualização técnica<br/>
<input type="radio" name='q4' id='q4[2]' value='100' <?php echo $q4[100]; ?>><span>(100)</span> O supervisor/coordenador e a equipe desenvolvem atividades internas de educação continuada e/ou atualização técnica
</div><!-- .question -->
<div class="clear"></div>

<?php
$q5[0] = (isset($resp['q5']) && $resp['q5'] == 0) ? 'checked' : '';
$q5[25] = (isset($resp['q5']) && $resp['q5'] == 25) ? 'checked' : '';
$q5[50] = (isset($resp['q5']) && $resp['q5'] == 50) ? 'checked' : '';
$q5[75] = (isset($resp['q5']) && $resp['q5'] == 75) ? 'checked' : '';
$q5[100] = (isset($resp['q5']) && $resp['q5'] == 100) ? 'checked' : '';
?>
<div class="question" id="q5superv_coord">
<p class="question_header">5. Atividades de ensino e pesquisa</p>
<input type="radio" name='q5' id='q5[0]' value='0' <?php echo $q5[0]; ?>><span>(0)</span> A equipe não está motivada para participação em atividades de ensino e pesquisa clínica<br/>
<input type="radio" name='q5' id='q5[1]' value='25' <?php echo $q5[25]; ?>><span>(25)</span> O supervisor/coordenador participa de atividades de ensino e pesquisa clínica mas não estimula participação dos liderados<br/>
<input type="radio" name='q5' id='q5[2]' value='50' <?php echo $q5[50]; ?>><span>(50)</span> Há pelo menos um protocolo de pesquisa clínica em fase de coleta de dados, com participação ativa da equipe<br/>
<input type="radio" name='q5' id='q5[3]' value='75' <?php echo $q5[75]; ?>><span>(75)</span> A equipe tem produção científica ativa, com pelo menos uma publicação no último ano<br/>
<input type="radio" name='q5' id='q5[4]' value='100' <?php echo $q5[100]; ?>><span>(100)</span> A equipe tem produção científica ativa, com média de 1 publicação/ano no últimos 5 anos</radio>
</div><!-- .question -->
<div class="clear"></div>

<?php
$q6[0] = (isset($resp['q6']) && $resp['q6'] == 0) ? 'checked' : '';
$q6[25] = (isset($resp['q6']) && $resp['q6'] == 25) ? 'checked' : '';
$q6[50] = (isset($resp['q6']) && $resp['q6'] == 50) ? 'checked' : '';
?>
<div class="question" id="q6superv_coord">
<p class="question_header">6. Planejamento estratégico</p>
<input type="radio" name='q6' id='q6[0]' value='0' <?php echo $q6[0]; ?>><span>(0)</span> A equipe não possui planejamento estratégico específico atualizado nos últimos 2 anos<br/>
<input type="radio" name='q6' id='q6[1]' value='25' <?php echo $q6[25]; ?>><span>(25)</span> Existe planejamento estratégico atualizado mas os planos de ação não apresentam andamento satisfatório<br/>
<input type="radio" name='q6' id='q6[2]' value='50' <?php echo $q6[50]; ?>><span>(50)</span> O planejamento estratégico está alinhado ao da instituição e os planos de ação apresentam andamento satisfatório
</div><!-- .question -->
<div class="clear"></div>

<?php
$q7[0] = (isset($resp['q7']) && $resp['q7'] == 0) ? 'checked' : '';
$q7[25] = (isset($resp['q7']) && $resp['q7'] == 25) ? 'checked' : '';
$q7[50] = (isset($resp['q7']) && $resp['q7'] == 50) ? 'checked' : '';
?>
<div class="question" id="q7superv_coord">
<p class="question_header">7. Liderança</p>
<input type="radio" name='q7' id='q7[0]' value='0' <?php echo $q7[0]; ?>><span>(0)</span> Dificuldade de comunicar-se com os liderados, usar a autoridade e controlar as emoções<br/>
<input type="radio" name='q7' id='q7[1]' value='25' <?php echo $q7[25]; ?>><span>(25)</span> Boa comunicação com a equipe mas com dificuldade de que as diretrizes sejam seguidas pelos liderados<br/>
<input type="radio" name='q7[' id='q7[2]' value='50' <?php echo $q7[50]; ?>><span>(50)</span> Boa interação com a equipe e interesse pelo desenvolvimento pessoal de cada liderado
</div><!-- .question -->
<div class="clear"></div>

<?php
$q8[0] = (isset($resp['q8']) && $resp['q8'] == 0) ? 'checked' : '';
$q8[25] = (isset($resp['q8']) && $resp['q8'] == 25) ? 'checked' : '';
$q8[50] = (isset($resp['q8']) && $resp['q8'] == 50) ? 'checked' : '';
?>
<div class="question" id="q8superv_coord">
<p class="question_header">8. Iniciativa/organização e método</p>
<input type="radio" name='q8' id='q8[0]' value='0' <?php echo $q8[0]; ?>><span>(0)</span> Necessita treinamento continuado para a solução de problemas em situações imprevistas<br/>
<input type="radio" name='q8' id='q8[1]' value='25' <?php echo $q8[25]; ?>><span>(25)</span> Planeja as atividades mas tem dificuldade em conseguir a execução das mesmas<br/>
<input type="radio" name='q8' id='q8[2]' value='50' <?php echo $q8[50]; ?>><span>(50)</span> Tem pró-atividade, organização e método para a solução de problemas e incremento das atividades assistenciais
</div><!-- .question -->
<div class="clear"></div>

<?php
$q9[0] = (isset($resp['q9']) && $resp['q9'] == 0) ? 'checked' : '';
$q9[25] = (isset($resp['q9']) && $resp['q9'] == 25) ? 'checked' : '';
$q9[50] = (isset($resp['q9']) && $resp['q9'] == 50) ? 'checked' : '';
?>
<div class="question" id="q9superv_coord">
<p class="question_header">9. Visão sistêmica e interatividade</p>
<input type="radio" name='q9' id='q9[0]' value='0' <?php echo $q9[0]; ?>><span>(0)</span> Não tem visão sistêmica institucional e sua supervisão/coordenação se limitam às atividades da equipe<br/>
<input type="radio" name='q9' id='q9[1]' value='25' <?php echo $q9[25]; ?>><span>(25)</span> Tem visão sistêmica institucional e suas ações visam a colaboração entre as equipes de anestesiologistas<br/>
<input type="radio" name='q9' id='q9[2]' value='50' <?php echo $q9[50]; ?>><span>(50)</span> Tem ações individuais para incremento dos resultados globais da Divisão de Anestesia
</div><!-- .question -->
<div class="clear"></div>

<?php
$q10[0] = (isset($resp['q10']) && $resp['q10'] == 0) ? 'checked' : '';
$q10[50] = (isset($resp['q10']) && $resp['q10'] == 50) ? 'checked' : '';
$q10[100] = (isset($resp['q10']) && $resp['q10'] == 100) ? 'checked' : '';
$q10[150] = (isset($resp['q10']) && $resp['q10'] == 150) ? 'checked' : '';
?>
<div class="question q_auto" id="q10superv_coord">
<p class="question_header">10. Desenvolvimento pessoal / profissional</p>
<input type="radio" name='q10' id='q10[0]' value='0' <?php echo $q10[0]; ?>><span>(0)</span> Não adota medidas atuais de desenvolvimento pessoal / profissional que se reflitam no desenvolvimento da equipe<br/>
<input type="radio" name='q10' id='q10[1]' value='50' <?php echo $q10[50]; ?>><span>(50)</span> Tem atividades de desenvolvimento pessoal / profissional mas as mesmas não tem sido transferidas para a equipe<br/>
<input type="radio" name='q10' id='q10[2]' value='100' <?php echo $q10[100]; ?>><span>(100)</span> Incorpora continuamente novos conhecimentos e os transfere para a equipe liderada<br/>
<input type="radio" name='q10' id='q10[3]' value='150' <?php echo $q10[150]; ?>><span>(150)</span> Tem especialização em administração hospitalar e se esforça para o aperfeiçoamento contínuo do conhecimento
</div><!-- .question -->
<div class="clear"></div>
