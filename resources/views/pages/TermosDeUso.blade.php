<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{env('APP_NAME')}}</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <!-- fontawesome icon  -->
        <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
        <!-- flaticon css -->
        <link rel="stylesheet" href="{{asset('assets/fonts/flaticon.css')}}">
        <!-- animate.css -->
        <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
        <!-- magnific popup -->
        <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/odometer.min.css')}}">
        <!-- stylesheet -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}?v={{today()}}">
        <!-- responsive -->
        <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/dashboard-responsive.css')}}">
    </head>

    <body>

        <!-- preloader begin -->
        <div class="preloader">
            <img src="assets/img/preloader.gif" alt="">
            <span>CARREGANDO...</span>
        </div>
        <!-- preloader end -->

        <!-- header begin -->
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6">
                            <div class="left-area">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        <span class="text">
                                            <span id="date"></span>
                                            <span id="month"></span>
                                            <span id="year"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-clock"></i>
                                        </span>
                                        <span class="text clocks">
                                            <span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6">
                            <div class="right-area">
                                <ul>
                                    <li>
                                        <a class="link" href="#">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 fa-fw fa-2x"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm128 421.6c-35.9 26.5-80.1 42.4-128 42.4s-92.1-15.9-128-42.4V416c0-35.3 28.7-64 64-64 11.1 0 27.5 11.4 64 11.4 36.6 0 52.8-11.4 64-11.4 35.3 0 64 28.7 64 64v13.6zm30.6-27.5c-6.8-46.4-46.3-82.1-94.6-82.1-20.5 0-30.4 11.4-64 11.4S204.6 320 184 320c-48.3 0-87.8 35.7-94.6 82.1C53.9 363.6 32 312.4 32 256c0-119.1 96.9-216 216-216s216 96.9 216 216c0 56.4-21.9 107.6-57.4 146.1zM248 120c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 144c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z" class=""></path></svg>
                                           FAZER LOGIN
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="navbar" class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-block align-items-center">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-6 d-xl-block d-lg-block d-flex align-items-center">
                                    <div class="logo">
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('assets/img/logo.png')}}" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                {{--<div class="col-6 d-xl-none d-lg-none d-block">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>--}}
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="mainmenu">
                                <nav class="navbar navbar-expand-lg">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                    </div>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header end -->


        <!-- login begin -->
        <div class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="login-form" style="white-space: pre-line;">
                            <h4>Termos de Uso</h4>

                            <p>
                                Os seguintes “Termos e Condições” regulam o uso de todos os produtos e serviços on-line da PaddockBet.com. Estes Termos e Condições são emitidos juntamente com as “Regras Específicas” dos diferentes produtos e serviços que oferecemos. Qualquer referência aos “Termos e Condições” inclui os termos e condições e as regras específicas. Caso haja alguma inconsistência entre os Termos e Condições e qualquer das Regras Específicas ou a Política de Privacidade ou qualquer outro documento mencionado neste Contrato, prevalecerão os seguintes Termos e Condições.
Paddockbet.com pertence e é operado por Paddock Bet  Inc Limited, Dewsbury Rd OSSETT West Yorkshire, WYK SW8 5DB, oferecendo jogos eletrônicos em formato de divisão de banca, popularmente conhecido como Bolão.


TERMOS GERAIS

Artigo 1. O CLIENTE DEVE LER E ACEITAR ESTES TERMOS E CONDIÇÕES ANTES DE REALIZAR DEPÓSITOS OU APOSTAS CONOSCO.

Artigo 2. Considera-se que cada cliente aceitou estes Termos e Condições, no momento de marcar a caixa do formulário de depósito/aposta clicando em ACEITO OS TERMOS E CONDIÇÕES. Ao aceitar estes Termos e Condições, bem como pelo uso contínuo de nosso site, o Cliente está vinculado por estes Termos e Condições, e por nossa Política de Privacidade, que é incorporada como uma referência nestes Termos e Condições.

Artigo 3. No entanto faremos todos os esforços razoáveis para garantir que qualquer alteração significativa nestes Termos e Condições seja notificada ao Cliente através de um aviso em nosso Site, reservamo-nos o direito de modificar os Termos e Condições a qualquer momento e sem aviso prévio.

Artigo 4. Os novos Termos e Condições substituem todos e quaisquer dos Termos e Condições anteriores

Artigo 5. Os novos Termos e Condições substituem todos e quaisquer dos Termos e Condições anteriores



O CLIENTE E SUA CAPACIDADE
Artigo 6. Como condição para a abertura de uma conta e o uso de qualquer um dos nossos produtos ou serviços, o Cliente declara e garante juradamente, que é maior de idade e que o jogo é legal sob a lei da jurisdição que corresponde a ele. Além disso, declara e garante que tem capacidade mental e legal para assumir a responsabilidade das suas próprias ações, para entrar em um acordo juridicamente vinculativo conosco.
Artigo 7. O Cliente é responsável por garantir a conformidade com as leis locais ou nacionais antes de fazer o registro, de acordo com a jurisdição correspondente.
Artigo 8. Não nos responsabilizamos pela violação do Cliente das leis locais ou nacionais aplicáveis, de acordo com a jurisdição correspondente. Reservamo-nos o direito, por qualquer motivo e a qualquer momento, de fechar sua conta ou suspender o acesso aos nossos sites para clientes que violarem este requisito. Também nos reservamos o direito de bloquear qualquer território por qualquer motivo legal ou de outro tipo, como a nossa conveniência.
Artigo 9. O Cliente entende e aceita que, ao usar nossos produtos e serviços, existe a possibilidade de ganhar e perder dinheiro.
Artigo 10. O Cliente não é obrigado a participar de nenhum de nossos produtos ou serviços, e essa participação, se for decidida por ele, fica a seu total critério e risco. O uso de qualquer software (seja obtido eletronicamente ou qualquer outro meio) em nosso site é nulo e sem efeito, incluindo, entre outros, falsificação, adulteração ou manipulação de qualquer tipo, se for ilegal, se for reproduzido mecânica ou eletronicamente, ou se for obtido fora dos canais autorizados ou se contém erros de impressão, produção, tipográficos, mecânicos, eletrônicos ou qualquer outro tipo de erro. Os lucros não serão pagos se tivermos suspeitas razoáveis do uso de qualquer uma das atividades descritas acima. Os erros devido à conexão do hardware, computador e Internet são de responsabilidade exclusiva do Cliente.
Artigo 11. É de responsabilidade exclusiva do Cliente ficar seguro de entender as regras e procedimentos específicos dos jogos, antes de participar deles.
Artigo 12. O Cliente não pode transferir seus direitos estabelecidos neste Contrato, sem o nosso consentimento prévio, que está sujeito a nosso critério exclusivo.
Artigo 13. É da responsabilidade do Cliente relatar alterações nos detalhes do seu registro.
Artigo 14. É esclarecido que o uso que o Cliente faz de qualquer um dos serviços de um provedor de pagamento estará sujeito aos Termos e Condições de uso prescrito por esse provedor de pagamentos. No entanto, isso não modifica ou afeta as obrigações que o Cliente adquiriu conosco em relação a estes Termos e Condições.
Artigo 15. O Cliente garante que não cometerá nenhum ato ou adotará qualquer conduta que seja, ou que possa danificar nossa reputação ou a reputação do fornecedor de software ou de qualquer outro provedor de serviços relacionados conosco.
Artigo 16. O Cliente garante que protegerá totalmente a InstaBET.com (incluindo, entre outros, o Fornecedor de software e outros fornecedores) de e contra toda e qualquer perda, custo, despesa, reivindicação, ação judicial que implique danos e prejuízos (incluindo despesas legais), independentemente de sua causa, que possam surgir como resultado da conexão, acesso e uso do site, os produtos de apostas esportivas ou do software, pelo cliente ou por qualquer outra pessoa que use seu nome de usuário e senha ou derivados de sua falha em cumprir com qualquer um dos termos e disposições destes Termos e Condições.
Artigo 17. Através deste contrato, o Cliente declara e garante que:
(a) Está agindo em seu próprio nome e não em nome de terceiros;
(b) Não fica classificado como jogador compulsivo ou profissional;
(c) Não está depositando ou usando de qualquer outra forma fundos de atividades criminais e/ ou ilegais e/ou não autorizadas;
(d) Não realiza ou participa de atividades criminosas ou ilegais de qualquer natureza, nem pretende usar sua conta em conexão com essas atividades; não usa ou pretende usar ou pretende permitir que outra pessoa use sua conta para finalidades ilegais ou proibidas;
(e) É o titular da conta bancária/chave pix do qual você forneceu os detalhes no processo de registro, e, portanto é o titular da conta que receberá eventuais saques e premiações
(F) Ao abrir sua conta, você não fornecerá ou nos forneceu nenhuma informação ou fará uma declaração incerta, falsa, incorreta, incompleta ou enganosa.
ABERTURA DE UMA CONTA
Artigo 18. Para acessar nossos produtos ou serviços, o Cliente deve abrir uma conta. Os clientes podem apostar até o valor depositado em sua conta, não concedemos créditos, os fundos depositados na conta não darão juros, em hipótese alguma.
Artigo 19. Somente é permitida uma conta por pessoa. Reservamo-nos o direito de fechar contas duplicadas ou quaisquer contas relacionadas ou suspeitas de ficar relacionadas com outras, e/ou invalidar quaisquer apostas feitas em contas duplicadas ou contas suspeitas de estarem relacionadas entre si.
Artigo 20. Você não tem permissão para se registrar no site e usar nossos serviços se for residente de Curaçao, França, Irã, Iraque, Holanda, Coreia do Norte, Cingapura, Espanha, St Maarten, Statia, EUA ou dependências dos EUA, Ucrânia, Reino Unido. Nós nos reservamos o direito de recusar clientes de qualquer outro país além das jurisdições mencionadas acima, a nosso critério.
Artigo 21. Você não pode transferir, vender ou penhorar sua conta para outra pessoa. Essa proibição inclui a transferência de quaisquer ativos de valor de qualquer tipo, incluindo, mas não se limitando à propriedade de contas, ganhos, depósitos, apostas, direitos e / ou reivindicações em relação a esses ativos, legais, comerciais ou outros. A proibição dessas transferências também inclui, no entanto, não se limita a oneração, penhor, cessão, usufruto, negociação, corretagem, hipoteca e / ou presente em cooperação com um fiduciário ou qualquer outro terceiro, empresa, pessoa física ou jurídica, fundação e / ou associação de qualquer forma ou forma
CONTROLE DO CRÉDITO E VERIFICAÇÃO DA IDADE
Artigo 22. Ao se registrar conosco, o Cliente concorda que podemos fornecer as informações recebidas às agências de referência de crédito autorizadas para confirmar seus dados de identidade da conta, o cliente concorda que podemos processar usar, registrar e divulgar as informações pessoais em relação ao seu registro, e que podemos armazenar essas informações. Para sua proteção, as chamadas telefônicas para o atendimento ao cliente podem ser gravadas e monitoradas.
Artigo 23. Para garantir que o Cliente seja maior de idade podemos solicitar uma prova quando uma conta for aberta, assim como temos direito de verificar qualquer informação fornecida.  De qualquer forma, se o Cliente não tiver sido capaz de concluir com êxito nossos controles de verificação de idade, temos o direito de congelar sua conta, ele será impedido de continuar apostando até que tenha concluído com êxito esses controles e, se no final da verificação o resultado é que o Cliente é menor de idade, devolveremos os valores depositados, mas sob nenhuma circunstância teremos a obrigação de pagar qualquer tipo de lucro.
Artigo 24. Teremos o direito de informar as autoridades relevantes, outros operadores de apostas esportivas, provedores de serviços on-line e bancos, emissores de cartões de crédito, fornecedores de pagamentos eletrônicos ou outras instituições financeiras sobre sua identidade e qualquer atividade ilegal e fraudulenta, impróprio ou suspeita: O Cliente garante que cooperará totalmente conosco para investigar qualquer atividade necessária.

NOME DO USUÁRIO, SENHA
Artigo 25. Ao abrir uma conta, os Clientes usam seu email como login e uma senha de própria esscolha que são usados para acessar suas contas. Estes devem ser mantidos em segurança. Os clientes podem alterar sua senha a qualquer momento, solicitando por escrito no e-mail fornecido no site de suporte ao cliente
Artigo 26 . O cliente é responsável pela confidencialidade de seu nome de usuário e senha. As apostas feitas por terceiros com capacidade legal e mental suficiente, e com a permissão do Cliente; serão consideradas válidas.
Artigo 27. O Cliente não permitirá que nenhuma outra pessoa ou terceiro (incluindo entre outros menores de idade) use sua conta regularmente ou aceite qualquer prêmio em seu nome.

DEPÓSITOS E RETIRADAS
Artigo 28. Oferecemos o método PIX para pagamento de  depósito ou retirada de uma conta.
Artigo 29. Ao abrir uma conta conosco, qualquer que seja o método de depósito, o Cliente garante que ele use seu próprio dinheiro. Temos o direito de entender que o cliente está fazendo isso.
Artigo 30. Podemos realizar qualquer processo de verificação, de forma que qualquer titular de conta seja obrigado a apresentar prova adicional de sua identidade quando necessário antes de fazer seu primeiro retiro de lucros.
Artigo 31. Se uma quantia em dinheiro é incorretamente creditada em sua conta, o Cliente é obrigado a notificar-nos dessa situação. Teremos o direito de recuperar a quantia (com juros) se o Cliente tiver retirado a quantia total ou parcialmente. Se você usar os pagamentos indevidamente para fazer apostas, a PaddockBet.com poderá cancelar essas apostas e reverter todos os lucros que possam ter ocorrido.
Artigo 32. O Cliente pode retirar fundos da sua conta a qualquer momento, se os pagamentos de todas as obrigações tenham sido confirmados e nossos procedimentos tenham sido concluídos.
Artigo 33. O Pagamento será efetuado por meio de pix somente usando como chave o cpf do próprio cliente.
Artigo 34. Quando o Cliente ganha usando nossos produtos ou serviços, ele pode ser legalmente obrigado a pagar impostos às autoridades fiscais competentes. Isso é de responsabilidade exclusiva do Cliente e não somos responsáveis perante nenhuma autoridade por nenhum de seus impostos pessoais. O Cliente nos indenizará e reembolsará os custos, despesas ou perdas que possam ser causados como resultado de qualquer reclamação ou demanda feita por qualquer autoridade governamental, com relação às obrigações de impostos, ou obrigações semelhantes retidos em relação ao processamento de seus pedidos de retirada.

Artigo 35. Podemos a nosso critério limitar o valor máximo de depósitos de um cliente para manter um ambiente de jogo saudável.
DAS REGRAS DO JOGO
Artigo 36. O Jogador deverá apostar através do sistema de cotas, escolhendo um conjunto por cota.
Artigo 37. A cada aposta, o “pote” total da prova é incrementado do valor da aposta, retirada a taxa de administração da PaddockBet que pode variar a cada prova a critério próprio.
Artigo 38. Antes da aposta o usuário terá um indicativo de multiplicador, baseado nas apostas até o momentos. Esse multiplicador/odd respeitará o sistema de bolão e poderá sofrer alterações até o fechamento das apostas para a prova.
Artigo 39. Na mesma aposta o jogador pode multiplicar o número de cotas apostadas e em caso de acerto, receberá proporcionalmente a div
Artigo 40. Uma vez iniciada a prova independente do horário, as apostas para aquela prova serão fechadas.
Artigo 41. Caso a prova seja cancelada, o valor integral da aposta será restituido a todos os apostadores e a taxa de administração da plataforma cancelada.
Artigo 42. Após o último conjunto será proclamado o vencedor e caso ganhe, o usuário terá creditado a divisão do pote daquela prova proporcional ao número de cotas apostado.
DOS GANHOS E SAQUES
Artigo 43. Uma vez creditado o resultado de uma aposta, o cliente pode usar o valor para novas apostas ou solicitar saque para sua conta corrente.
Artigo 44. A PaddockBet efetuará o pagamento via PIX com a chave CPF do cliente informado na hora do cadastro, num prazo de até 48h úteis.
Artigo 45. Em Caso de erros sistêmicos, de conexão, hardware, software ou qualquer outro que interfira na perfeita correção  dos valores, a PaddockBet se reserva ao direito de cancelar a aposta e os ganhos ou perdas dela proveniente.

RECLAMAÇÕES
Artigo 47. Em caso de dúvidas ou reclamações o cliente deve utilizar o email suporte@paddockbet.com e terá sua reclamação respondida através do email cadastro.
Artigo 48. Opcionalmente o cliente pode utilizar o link no rodapé do site para contato via Whatsapp que será respondido de acordo com a ordem de chegada e em horário comercial, salvo em dias de provas nos fins de semana.
FRAUDE
Artigo 49. Serão buscadas as sanções legais e contratuais mais completas contra qualquer Cliente envolvido em fraude. Além disso, reteremos o pagamento de qualquer cliente suspeito de fraude.
Artigo 50. O Cliente indenizará e será responsável pelo pagamento de todos os custos, despesas ou perdas sofridas (incluindo, mas não limitado a qualquer perda direta, indireta ou consequente, perda de lucro, perda de reputação ou dano ao bom nome da InstaBET.com) que surjam direta ou indiretamente de fraude, desonestidade ou ato criminoso.

DIREITOS DA PADDOCKBET
Artigo 51. Sem prejuízo de qualquer declaração explícita, você pode a qualquer momento, sem aviso prévio e sem perda de nossos direitos ao abrigo deste Contrato, TERMINAR O SEU DIREITO DE USAR O SOFTWARE, ACESSAR O NOSSO SITE E FECHAR A SUA CONTA se considerar que Você violou qualquer um dos Termos e Condições deste Contrato.
Artigo 52. Teremos o direito de reter, diminuir ou alterar qualquer valor de lucro ou modificar qualquer política caso suspeitemos que o Cliente esteja abusando ou tentando abusar da forma para qual o sistema foi projetado
Artigo 53. Podemos, a qualquer momento, compensar qualquer saldo positivo em sua conta com qualquer valor devido pelo Cliente.
Artigo 54. Podemos transferir, ceder, sublicenciar, ou dar este Contrato em garantia seja de forma total ou em parte, a qualquer pessoa ou entidade sem aviso prévio, e o Cliente será considerado como tendo dado seu consentimento.

RESPONSABILIDADE
Artigo 55. Somos obrigados a pagar apenas os lucros que foram realmente derivados de acordo com nossos Termos e Condições.
Artigo 56. O Cliente aceita que nossos produtos e serviços e o site correspondente sejam fornecidos “como estão” com qualquer falha ou defeito, de modo que nenhuma representação, condição ou garantia seja expressa ou implícita (incluindo, entre outros, qualquer garantia implícita de precisão, integridade, provisão ininterrupta, qualidade, comercialização, adequação a um objetivo específico ou não violação) é excluído na extensão máxima permitida pela lei.
Artigo 57. Sob nenhuma circunstância (incluindo negligência), nós ou o Fornecedor de Software seremos responsáveis por qualquer lesão, perda, reclamação, perda de dados, renda, lucro, perda ou dano da propriedade, dano geral, danos direto, indireto, incidental ou danos especiais, exemplares ou punitivos, consequentes, o de qualquer natureza, decorrentes ou relacionados ao acesso de qualquer Cliente, uso ou incapacidade de usar nossos produtos e serviços e/ou o site, qualquer software, qualquer material ou outras informações em nosso site ou qualquer bem, material ou serviço disponível nele (seja com base em contrato, delito ou devido a negligência, ou outra forma), mesmo que tenhamos sido avisados da possibilidade de tais danos ou perdas ou que tal perda era previsível.
Artigo 58. O Cliente aceita especificamente seu acordo em relação a que nem nós, nem o Fornecedor de Software, nem qualquer uma de nossas afiliadas e partes relacionadas, somos responsáveis por:
(a) Conduta difamatória, ofensiva ou ilegal de qualquer outro Cliente;
(b) Qualquer perda resultante do uso, abuso ou uso indevido da sua conta ou de qualquer um de nossos produtos e serviços e o site correspondente;
(c) Qualquer perda incorrida na transmissão de informações em nosso site via Internet ou por e-mail;
(d) Qualquer falha técnica, falhas do sistema, defeito, atraso, interrupção, transmissão incorreta de dados, perda ou corrupção dos dados ou falha nas linhas de comunicação (incluindo falhas que afetam a capacidade do caminho de retorno da televisão interativa), ataques do tipo “denial service”, vírus ou qualquer outra consequência tecnológica adversa, relacionada com sua escolha de usar nossos produtos e serviços;
(e) A precisão, integridade ou atualização de qualquer serviço de informações fornecido (incluindo preços, corredores, horários, os resultados ou estatísticas gerais) ou quaisquer resultados ao vivo, estatísticas e resultados intermédios que aparecem em nossos sites Web;
(f) Qualquer atraso no recebimento ou na aceitação de um depósito ou na retenção de uma retirada com o objetivo de executar procedimentos de verificação da identidade.
(g) Qualquer transação na sua conta que seja feita após a entrada correta do seu nome de usuário e senha; também por qualquer fechamento ou bloqueio de sua conta de acordo com os Termos e Condições deste Contrato, incluindo pagamentos de danos e prejuízos, aos quais o Cliente renuncia expressamente.
(h) Nenhum resultado de qualquer ato das autoridades ou qualquer evento fortuito ou força maior.

 PROPRIEDADE INTELECTUAL
Artigo 59. O Cliente aceita que todos os direitos de propriedade intelectual deste site, do software e as informações relacionadas nestes Termos e Condições são de propriedade da Empresa.
Artigo 60. Além disso o Cliente aceita que:
(a) Todos os materiais em nosso site (incluindo o desenho, texto, gráfico e fotografias) são de propriedade da empresa; e
(b) A empresa é proprietária ou licenciada autorizada das marcas comerciais, logotipos e nomes comerciais que aparecem neste site, e o Cliente pode apenas usar as referidas marcas comerciais com o único objetivo de exibir este site em seus equipamentos e/ou realizar transações no site.
Artigo 61. O Cliente não pode transferir, copiar, reproduzir, distribuir, usar ou fazer qualquer outro uso dos materiais deste Site de qualquer maneira que não seja para fins de exibição na tela do computador e/ou impressão, a fim de olhar o conteúdo. O cliente não pode vincular este site com qualquer outro site sem nossa prévia autorização.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login end -->

         <!-- footer begin -->
         <div class="footer" id="contact">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-10">
                        <div class="about-widget">
                            <a class="logo" href="index.html">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                            <p>PaddockBet: Seu site de apostas em Saltos.</p>
                            <div class="social">
                                <ul>
                                    <li>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-pinterest-p"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="support">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <img src="assets/img/svg/email.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">E-mail</span>
                                            <span class="descr">suporte@PaddockBet</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <img src="assets/img/svg/phone-call.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">Telefone</span>
                                            <span class="descr">+155000000000</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">
                            <h3>Useful links</h3>
                            <ul>
                                <li>
                                    <a href="#">IN-PLAY</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                    {{--<div class="col-xl-2 col-lg-3 col-md-3">
                        <div class="useful-links">
                            <h3>Connect With Us</h3>
                            <ul>
                                <li>
                                    <a href="#">About Us</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                    {{--<div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">
                            <h3>All Sports</h3>
                            <ul>
                                <li>
                                    <a href="#">FOOTBALL</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                </div>
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="payment-method">
                                    <h6 class="payment-method-title">
                                        Métodos de pagamentos aceitos
                                    </h6>
                                    <div class="all-method">
                                        <div class="single-method">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg" alt="">
                                        </div>
                                        {{--<div class="single-method">
                                            <img src="assets/img/brand-2.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-3.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-4.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-5.png" alt="">
                                        </div>

                                        <div class="single-method">
                                            <img src="assets/img/brand-5.png" alt="">
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end -->

        <!-- notes begin -->
        <div class="notes">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10">
                        PaddockBet &copy; {{Carbon\Carbon::now()->format('Y')}} |  Todos os direitos reservados.
                    </div>
                </div>
            </div>
        </div>
        <!-- notes end -->

        <!-- copyright footer begin -->
        <div class="copyright-footer">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-md-6 col-lg-6 d-lg-flex d-lg-flex d-block align-items-center">
                        <p class="copyright-text">
                            <a href="#">Paddock</a> © 2020. PRIVACY POLICY
                        </p>
                    </div>
                    {{--<div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                        <p class="copyright-text">
                            Desenvolvido com <i class="fa fa-heart" style="color: #ff0000"></i> por <a href="https://www.linkedin.com/in/alisson-santos-9332b7219/" target="_blank" style="text-decoration: underline;">Alisson Santos</a>
                        </p>
                    </div>--}}
                </div>
            </div>
        </div>
        <!-- copyright footer end -->

        <!-- jquery -->
        <!-- <script src="assets/js/jquery.js"></script> -->
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- owl carousel -->
        <script src="assets/js/owl.carousel.js"></script>
        <!-- magnific popup -->
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <!-- filterizr js -->
        <script src="assets/js/jquery.filterizr.min.js"></script>
        <!-- wow js-->
        <script src="assets/js/wow.min.js"></script>
        <!-- clock js -->
        <script src="assets/js/clock.min.js"></script>
        <script src="assets/js/jquery.appear.min.js"></script>
        <script src="assets/js/odometer.min.js"></script>
        <!-- main -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
