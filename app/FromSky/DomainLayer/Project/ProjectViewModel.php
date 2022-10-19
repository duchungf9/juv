<?php

namespace App\FromSky\DomainLayer\Project;

use App\FromSky\DomainLayer\Website\WebsiteViewModel;
use App\Model\Project;


class ProjectViewModel extends WebsiteViewModel
{
    function show(string $slug)
    {
        $project = Project::findBySlug($slug, app()->getLocale());
        $page    = $this->getCurrentPage();
        if ($project) {
            $category    = $project->category;
            $locale_page = $project;
            $this->setSeo($project);
            return view('website.project', compact('page', 'project', 'category', 'locale_page'));
        }
        return $this->handleMissingPage();
    }
}