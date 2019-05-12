<?php

namespace Command;

use App\Model\Domains\Repositories\Article\ArticleRepository;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ArticleFakerCommand
 */
class ArticleFakerCommand extends Command
{
    private $faker;
    private $articleRepository;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $this->faker = Factory::create('zh_CN');
        $this->articleRepository = new ArticleRepository();
    }

    /**
	 * Configure
	 */
	protected function configure()
	{
		$this->setName('article:faker')
			->setDescription('create article test data');
	}


	/**
	 * Execute
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
	    for ($i = 0; $i < 10; $i++) {
	        $title = $this->faker->realText(20, 5);
	        $content = $this->faker->paragraph;
	        $status = rand(0, 2);

	        $article = $this->articleRepository->create([
	            'title' => $title,
                'content' => $content,
                'status' => $status,
                'author_id' => 2,
            ]);
	        $output->writeln($article);
        }
	}
}
