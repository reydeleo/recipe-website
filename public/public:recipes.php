<?php 
require '../vendor/autoload.php';
require "../generated-conf/config.php";

$settings = ['displayErrorDetails' => true];
$app = new \Slim\App(["settings" => $settings]);

// Twig setup
$container = $app->getContainer();

// note that this file lives in a subdirectory, so templates is up a level
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig("../templates/", [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension (from the docs)
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$app->get('/{id}', function($request, $response, $args) {
	// access named argument from path
    $recipeId = $args['id'];
    // echo $recipeId;
    $recipe = RecipeQuery::create()->findPk($recipeId);
    // echo $recipe;
    // $steps = $recipe->getStepss();
    $query = StepsQuery::create()->orderBy("StepNumber");
    $steps = $recipe->getStepss($query);
    
    $response = $this->view->render($response, "recipeInfo.html", ['recipe' => $recipe, 'steps' => $steps]);
});


$app->get('/', function($request, $response, $args) {
	
    $recipes = RecipeQuery::create()->orderBy('Name')->find();
	$response = $this->view->render($response, "mainPage.html", ['recipes' => $recipes]);
});

$app->get('/changeName/{id}/{name}', function($request, $response, $args){
    //check tha tthey are authorized to edit

    $pn = RecipeQuery::create()->findPk($args['id']);
    $pn->setName($args['name']);
    $pn->save();

//    $response->getBody()->write("Ok");
    $response->getBody()->write($args['name']);

}); 

$app->get('/changeStep/{id}/{info}', function($request, $response, $args){
    $step = StepsQuery::create()->findPk($args['id']);
    $step->setDescription($args['info']);
    $step->save();
    $response->getBody()->write($args['info']);
});

$app->get('/addStep/{id}/{info}', function($request, $response, $args){
    $information = $args['info'];
    $recipe = RecipeQuery::create()->findPk($args['id']);
    $steps = $recipe->getStepss();
    $numSteps = 0;
    foreach($steps as $oneStep){
        $numSteps = $numSteps + 1;
    }

    $step = new Steps();
    $step->setStepNumber($numSteps + 1);
    $step->setDescription($args['info']);
    $step->setRecipeId($args['id']);
    $step->save();
    $stpId = $step->getId();

    $data = array('info'=>$information, 'stepid' => $stpId);
    $response->getBody()->write(json_encode(($data)));
});

$app->get('/reorder/{id}/{stepNum}', function($request, $response, $args){
    $step = StepsQuery::create()->findPk($args['id']);
    $currentStepNum = $step->getStepNumber();
    $recipe = $step->getRecipe();
    $steps = $recipe->getStepss();
    if($currentStepNum < $args['stepNum'])
    {   
        foreach($steps as $singleStep){
            if( ($singleStep->getStepNumber() <= $args['stepNum']) && ($singleStep->getStepNumber() > $currentStepNum) ){
                $sn = $singleStep->getStepNumber();
                $sn = $sn - 1;
                echo $sn;
                $singleStep->setStepNumber($sn);
                $singleStep->save();
            }
        }

    }
    else if($currentStepNum > $args['stepNum'])
    {
            foreach($steps as $singleStep){
            if(($singleStep->getStepNumber() >= $args['stepNum']) && ($singleStep->getStepNumber() < $step->getStepNumber()))
            {
               $sn = $singleStep->getStepNumber();
               $sn = $sn + 1;
               echo $sn;
               $singleStep->setStepNumber($sn);
               $singleStep->save();
            }
        }
    }
        
    $step->setStepNumber($args['stepNum']);
    $step->save();
});



$app->run();