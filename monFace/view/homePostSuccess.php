<div class="container-fluid mt-4 ">
    <div class="row">
        <div class="col-8">
            <div class="card post">
                <div class="card-body">
                    <h5 class="card-title"><img src="./images/fp1.jpeg" alt="user" class="fp-picture">  Noell EVEQUE</h5>
                    <h6 class="card-subtitle mb-2 text-muted">14 Novembre 2018</h6>
                    <p class="card-text">beau paysage.</p>
                    <img class="mx-auto d-block post-picture" src="./images/post1.jpg" alt="image">
                    <div class="post-icons">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-danger" href="#"><i class="fa fa-heart post-icon"> <?php if($context->like){ print_r($context->like[0]['aime']); } ?> </i></button>
                            <button type="button" class="btn btn-outline-danger" href="#"><i class="fa fa-comment post-icon"> 10</i></button>
                            <button type="button" class="btn btn-outline-danger" href="#"><i class="fa fa-share-alt post-icon"> 10</i></button>
                        </div>
                    </div>
                    <div class="comment">
                        <h5 class="card-title"><img src="./images/fp3.jpeg" alt="user" class="fp-picture">  Maria LOSTEN</h5>
                        <p class="card-text">Magnifique </p>
                    </div>
                </div>                    
            </div>
            <div class="card post">
                <div class="card-body">
                    <h5 class="card-title"><img src="./images/fp2.jpeg" alt="user" class="fp-picture">   Michelle LANDORE</h5>
                    <h6 class="card-subtitle mb-2 text-muted">10 Novembre 2018</h6>
                    <p class="card-text">Good bye summer.</p>
                    <img class="mx-auto d-block post-picture" src="./images/post2.jpeg" alt="image">
                    <div class="post-icons">
                        <i class="fa fa-heart post-icon"> 18</i>
                        <i class="fa fa-comment post-icon"></i>
                        <i class="fa fa-share-alt post-icon"> 3</i>
                    </div>
                </div>
            </div>
            <div class="card post">
                <div class="card-body">
                    <h5 class="card-title"><img src="./images/fp3.jpeg" alt="user" class="fp-picture">  Maria LOSTEN</h5>
                    <h6 class="card-subtitle mb-2 text-muted">9 Novembre 2018</h6>
                    <p class="card-text">Belle journée avec mes potes.</p>
                    <div class="post-icons">
                        <i class="fa fa-heart post-icon"> 3</i>
                        <i class="fa fa-comment post-icon"></i>
                        <i class="fa fa-share-alt post-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>