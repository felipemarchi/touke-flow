<?php

	$node = new \TYPO3\Surf\Domain\Model\Node('touke');
	$node->setHostname('ssh2.eu1.frbit.com');
	$node->setOption('username', 'u-touke');
   

	$application = new \TYPO3\Surf\Application\TYPO3\Flow();
	$application->setDeploymentPath('/var/www/web/touke/htdocs');
	$application->setOption('repositoryUrl', 'https://github.com/colares/touke-flow.git');
   $application->setOption('composerCommandPath', '/usr/local/bin/composer');
   $application->setOption('keepReleases', 2);
   

   //   $application->setOption('composerCommandPath', 'php /var/www/vhosts/neos.typo3.org/home/composer.phar');
   
	$application->addNode($node);

	$deployment->addApplication($application);
   
   /**
    * renenabled it JUST after create a DB setup file
    */
   $workflow = $deployment->getWorkflow();
   $deployment->onInitialize(function() use ($workflow, $application) {
       $workflow->removeTask('typo3.surf:typo3:flow:migrate');
   });

?>