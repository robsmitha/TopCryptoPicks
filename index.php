<?php
include "DAL/cart.php";
include "DAL/cartitem.php";
include "DAL/statustype.php";
session_start();
include "Utilities/SessionManager.php";
include "DAL/subscription.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

  <body id="page-top">
<style>
    .portfolio-item .caption {
        background: none;
    }
</style>
  <!-- Navigation -->
  <a class="menu-toggle rounded" href="#">
      <i class="fa fa-bars"></i>
  </a>
  <nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
          <li class="sidebar-brand">
              <a class="js-scroll-trigger" href="#page-top">Top Crypto Picks</a>
          </li>
          <li class="sidebar-nav-item">
              <a class="js-scroll-trigger" href="#page-top">Home</a>
          </li>
          <li class="sidebar-nav-item">
              <a class="js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="sidebar-nav-item">
              <a class="js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="sidebar-nav-item">
              <a class="js-scroll-trigger" href="#portfolio">Portfolio</a>
          </li>
          <li class="sidebar-nav-item">
              <a class="js-scroll-trigger" href="#footer">Contact</a>
          </li>
      </ul>
  </nav>

    <!-- Header -->
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
        <h1 class="mb-1 white">Top Crypto Picks</h1>
        <h3 class="mb-5 white">
          <em>Subscribe for our latest updates</em>
        </h3>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Learn More</a>
          <?php
          if(SessionManager::getCustomerId() == 0 && SessionManager::getSecurityUserId() == 0 ){
              ?>
              <a class="btn btn-dark btn-xl js-scroll-trigger" href="login.php">Login</a>
              <?php
          }
          else{
              ?>
              <a class="btn btn-dark btn-xl js-scroll-trigger" href="dashboard.php">Dashboard</a>
              <?php
          }
          ?>

      </div>
      <div class="overlay"></div>
    </header>

    <!-- About -->
    <section class="content-section bg-light" id="about">
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h2>Cryptocurrency. Investment. Research.</h2>
            <p class="lead mb-5">
                Crypto-Trading is the act of buying and selling cryptocurrencies through an exchange (trading platform).
                The term “crypto” is the prefix for the word cryptography; which is the structure of techniques that secret writing, especially code and cipher systems that is sometimes used to decentralize systems for security purposes.
            </p>
            <a class="btn btn-dark btn-xl js-scroll-trigger" href="#services">What We Offer</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Services -->
    <section class="content-section bg-primary text-white text-center" id="services">
      <div class="container">
        <div class="content-section-heading">
          <h3 class="text-dark mb-0">Services</h3>
          <h2 class="mb-5 white">What We Offer</h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="service-icon rounded-circle mx-auto mb-3">
              <i class="icon-screen-smartphone"></i>
            </span>
            <h4>
              <strong>Subscriptions</strong>
            </h4>
            <p class="text-faded mb-0">Looks great on any screen size!</p>
          </div>
          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="service-icon rounded-circle mx-auto mb-3">
              <i class="icon-pencil"></i>
            </span>
            <h4>
              <strong>Insight</strong>
            </h4>
            <p class="text-faded mb-0">Freshly redesigned for Bootstrap 4.</p>
          </div>
          <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
            <span class="service-icon rounded-circle mx-auto mb-3">
              <i class="icon-like"></i>
            </span>
            <h4>
              <strong>An Edge</strong>
            </h4>
            <p class="text-faded mb-0">Millions of users
              <i class="fa fa-heart"></i>
              Start Bootstrap!</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <span class="service-icon rounded-circle mx-auto mb-3">
              <i class="icon-mustache"></i>
            </span>
            <h4>
              <strong>Financial Independence</strong>
            </h4>
            <p class="text-faded mb-0">I mustache you a question...</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Callout -->
    <section class="callout">
      <div class="container text-center">
        <h2 class="mx-auto mb-5 white">Welcome to
          <em>your</em>
          next website!</h2>
          <?php
          if(SessionManager::getCustomerId() == 0 && SessionManager::getSecurityUserId() == 0 ){
              ?>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="login.php">Login</a>
              <?php
          }
          else{
              ?>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="dashboard.php">Dashboard</a>
              <?php
          }
          ?>
      </div>
    </section>

    <!-- Portfolio -->
    <section class="content-section" id="portfolio">
      <div class="container">
        <div class="content-section-heading text-center">
          <h3 class="text-dark mb-0">Our bread and butter</h3>
          <h2 class="mb-5">SUBSCRIPTIONS</h2>
        </div>
        <div class="row no-gutters">
          <!--<div class="col-lg-6">
            <a class="portfolio-item" data-toggle="modal" data-target="#myModal">
              <span class="caption">
                <span class="caption-content">
                  <h1 class="white">DAILY: $25</h1>
                  <p class="mb-0">1 Calendar Day – All Sports Picks</p>
                </span>
              </span>
              <img class="img-fluid" src="img/portfolio-1.jpg" alt="">
            </a>
          </div>-->
            <?php
            $subscriptionList = Subscription::loadall();
            if(!empty($subscriptionList)){
                foreach ($subscriptionList as $subscription){
                    ?>
                    <div class="col-md-4">
                        <a class="portfolio-item" href="view-subscription.php?id=<?php echo $subscription->getId() ?>">
                          <span class="caption">
                                <span class="caption-content text-center">

                                </span>
                          </span>
                            <img class="img-fluid" src="<?php echo $subscription->getImgUrl(); ?>" alt="">
                        </a>
                        <span class="caption-content text-center">
                          <h1 class="text-primary"><?php echo $subscription->getName(); ?></h1>
                          <p class="mb-0"><?php echo $subscription->getDescription(); ?></p>
                        </span>
                    </div>
            <?php
                }
            }
            ?>
        </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="content-section bg-primary text-white">
      <div class="container text-center">
          <?php
          if(SessionManager::getCustomerId() == 0 && SessionManager::getSecurityUserId() == 0 ){
              ?>
              <h2 class="white">What are you waiting for?</h2>
              <h5 class="mb-4 white">Get started today!</h5>
              <a href="login.php" class="btn btn-xl btn-light mr-4">Login</a>
              <a href="create-customer.php" class="btn btn-xl btn-dark">Register</a>
              <?php
          }
          else{
              ?>
              <h2 class="white">What are you waiting for?</h2>
              <h5 class="mb-4 white">Checkout the latest cryptocurrencies!</h5>
              <a href="dashboard.php" class="btn btn-xl btn-light mr-4">Dashboard</a>
          <?php
          }
          ?>

      </div>
    </section>

    <!-- Map
    <section id="contact" class="map">
      <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
      <br/>
      <small>
        <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
      </small>
    </section> -->
  <?php include "footer.php" ?>
<?php include "scripts.php" ?>
<?php include "modal.php" ?>
  </body>

</html>
