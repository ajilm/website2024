<?php
/**
 * Template Name: About Template
 * Description:  
 */
get_header();
?>  
 
<body>
    <div class="container my-5">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold">About Trader's Diary</h1>
            <p class="lead text-muted">Your Trusted Partner in Stock Trading</p>
        </header>

        <section class="mb-5">
            <h2 class="h3 mb-3">Our Mission</h2>
            <p class="fs-5">
                At Trader's Diary, we're committed to empowering investors of all levels with cutting-edge tools and insights to navigate the complex world of stock trading. Our platform is designed to make trading accessible, efficient, and rewarding.
            </p>
        </section>

        <section class="mb-5">
            <h2 class="h3 mb-4">Why Choose Trader's Diary?</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <i class="fas fa-chart-line me-2"></i>Advanced Analytics
                            </h3>
                            <p class="card-text">
                                Leverage our powerful analytical tools to make informed decisions based on real-time market data and trends.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <i class="fas fa-globe me-2"></i>Global Markets
                            </h3>
                            <p class="card-text">
                                Access a wide range of markets worldwide, including stocks, ETFs, and more, all from a single platform.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <i class="fas fa-lock me-2"></i>Security First
                            </h3>
                            <p class="card-text">
                                Your security is our top priority. We employ state-of-the-art encryption and security measures to protect your investments and data.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <i class="fas fa-graduation-cap me-2"></i>Educational Resources
                            </h3>
                            <p class="card-text">
                                From beginners to experts, our comprehensive educational resources help you enhance your trading skills and knowledge.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h3 mb-3">Our Story</h2>
            <p class="fs-5 mb-3">
                Founded in 2010, Trader's Diary has grown from a small startup to a leading name in online stock trading. Our journey has been driven by a passion for innovation and a commitment to our users' success.
            </p>
            <p class="fs-5">
                Today, we serve millions of traders worldwide, continuously evolving our platform to meet the dynamic needs of the global financial markets.
            </p>
        </section>

        <section class="text-center">
            <h2 class="h3 mb-3">Ready to Start Trading?</h2>
            <p class="fs-5 mb-4">Join thousands of successful traders on Trader's Diary today.</p>
            <a href="<?php echo site_url('login');?>" class="btn btn-primary btn-lg">Open Your Account</a>
        </section>
    </div>
 
 
<?php get_footer(); ?>