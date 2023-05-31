<?php

namespace Mindbird\ContaoNodeOverlay\Controller;

use Contao\BackendTemplate;
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\FragmentTemplate;
use Contao\StringUtil;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Terminal42\NodeBundle\NodeManager;

#[AsContentElement(NodesOverlayContentElementController::TYPE, category: "includes")]
class NodesOverlayContentElementController extends AbstractContentElementController
{

    public const TYPE = 'nodes_overlay';

    public function __construct(private ScopeMatcher $scopeMatcher, private NodeManager $nodeManager)
    {

    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        if ($this->scopeMatcher->isBackendRequest($request)) {
            $template = new BackendTemplate('be_wildcard');
            $template->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE'][self::TYPE] . ' ###';
            return $template->getResponse();
        }
        $GLOBALS['TL_CSS'][] = 'bundles/contaonodeoverlay/nodes_overlay.css ';

        $ids = StringUtil::deserialize($model->nodes, true);
        $ids = array_map('intval', $ids);
        $template->content = implode('', $this->nodeManager->generateMultiple($ids));

        $template->untilDate = '';
        if ($model->stop !== '') {
            $untilDate = \DateTime::createFromFormat('U', $model->stop);
            $template->untilDate = $untilDate->format('c');
        }

        $template->showOnlyOnce = $model->showOnlyOnce === '1' ? 1 : 0;
        $template->elementId = $model->id;
        $template->elementHash = md5($template->content);

        return  $template->getResponse();
    }
}