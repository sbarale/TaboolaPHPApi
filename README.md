###F15D Taboola API
Um pacote para fazer requisições para o **Backstage** do [Taboola](https://www.taboola.com).
Pacote criado para uso com o framework Laravel.

O pacote está em desenvolvimento, no momento so faz do tipo **report**, o restante será adicionado em novas versões

####Requisitos

1. PHP 7+
2. Laravel 5+
3. Taboola client_id e client_secret
4. Taboola account_name

####Configuração

Adicione as variaveis ao `.env`

````dotenv
TABOOLA_CLIENT_ID=CLIENT_ID
TABOOLA_CLIENT_SECRET=CLIENT_SECRET
TABOOLA_ACCOUNT_NAME=ACCOUNT_NAME
````

Registre o provider e os alias no ``config/app.php``

````php
'providers' => [
    /** ...* /
    /** Taboola Provider */
    F15DTaboola\F15DTaboolaProvider::class,
],
````

````php
'aliases' => [
    /** ...* /
    /** Taboola Facades */
    'CampaignSummary' => \F15DTaboola\Facades\Reports\CampaignSummary::class,
    'RecirculationSummary' => \F15DTaboola\Facades\Reports\RecirculationSummary::class,
    'TopCampaignContent' => \F15DTaboola\Facades\Reports\TopCampaignContent::class,
    'VisitValue' => \F15DTaboola\Facades\Reports\VisitValue::class,
],
````

####Uso

Escolha o tipo de report, a lista completa você pode ver nesse [link](https://github.com/taboola/Backstage-API/blob/master/Backstage%20API%20-%20Reports.pdf)

Todos os tipos de report dependem de informar a data de inicio e a de final, que são informados com os metodos **setStartDate** e **setEndDate**, sem eles vai ser gerado um Exception,

As dimensions podem ser usadas no padrão camelCase.

````php
$visitValue = VisitValue::setStartDate('2018-05-01')
    ->setEndDate('2018-05-31')
    ->landingPageBreakdown();
````