<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Available News</h2>
        </div>
        <div class="row clearfix">            
            <!-- Badges -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CATEGORIES
                            <small>Get your desired news Categories</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul class="list-group">
                            <button type="button" class="list-group-item">Current Affairs <span class="badge bg-pink">14 new</span></button>
                            <button type="button" class="list-group-item">Local <span class="badge bg-cyan">99 read</span></button>
                            <button type="button" class="list-group-item">Technology <span class="badge bg-teal">99+</span></button>
                            <button type="button" class="list-group-item">Science <span class="badge bg-orange">21</span></button>
                            <button type="button" class="list-group-item">Computing <span class="badge bg-purple">18</span></button>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Badges -->
	        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            You searched for <span class="text-success font-24"><?= $search_term; ?></span>
                            <small>News Obtained from Various Facebook Pages</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <span class="text-center">
                    </span>  
                    <?php foreach ($news_data as $key => $news): ?>
                    <div class="body">
                        <div class="media">
                            <div class="media-left">
                                <a href="javascript:void(0);">
                                    <img class="media-object" src="<?= $news['picture']; ?>" width="134" height="134">
                                </a>
                            </div>
                            <div class="media-body">

                                <h3 class="media-heading" style="font-size: 2em !important;"><?= $news['message']; ?></h3> <?= $news['description']; ?>
                                <br><br>
                                <span class="badge bg-green"> <strong><?= $news['up_vote']; ?></strong></span> upvotes and <span class="badge bg-black"> <strong><?= $news['down_vote']; ?></strong> </span> downvotes  
                                <a type="button" class="btn bg-red waves-effect waves-light pull-right" href="<?= $news['link']; ?>" target="_blank">Read Full Story</a>
                                <hr/>
                                <span class="upvote" data-id="<?= $news['object_id']; ?>"> </span><span class="downvote" data-id="<?= $news['object_id']; ?>"> </span>>                                
                            </div>
                            
                        </div>

                    </div>
                    <?php endforeach; ?>
                    <hr />
                    <span class="text-center">
                    </span>                   
                </div>
            </div>
        </div>

    </div>
</section>