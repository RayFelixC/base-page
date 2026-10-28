import React from 'react';
import ReactDOM from 'react-dom';

const features = [
    {
        title: 'Laravel 10 + PHP 8.3',
        text: 'Routing, Eloquent ORM, Blade templating and Sanctum API authentication, ready out of the box.',
    },
    {
        title: 'Authentication ready',
        text: 'Login, registration, password reset and email verification powered by Laravel UI.',
    },
    {
        title: 'Bootstrap 5 + Sass',
        text: 'A responsive, mobile-first UI with customizable SCSS variables and Bootstrap Icons.',
    },
    {
        title: 'React 17 integration',
        text: 'Mount interactive components anywhere in your Blade views with Laravel Mix and JSX.',
    },
];

function Landing() {
    return (
        <React.Fragment>
            {/* Hero */}
            <section className="bg-light border-bottom py-5">
                <div className="container text-center py-4">
                    <h1 className="display-5 fw-bold">Base Laravel Page</h1>
                    <p className="lead text-muted mx-auto mb-4" style={{ maxWidth: '42rem' }}>
                        A clean, scalable starter template for building modern web applications
                        with Laravel, Bootstrap and React.
                    </p>
                    <div className="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="#features" className="btn btn-primary btn-lg px-4 gap-3">
                            Get started
                        </a>
                        <a href="#cta" className="btn btn-outline-secondary btn-lg px-4">
                            Learn more
                        </a>
                    </div>
                </div>
            </section>

            {/* Features */}
            <section id="features" className="py-5">
                <div className="container">
                    <div className="row text-center mb-5">
                        <div className="col-lg-8 mx-auto">
                            <h2 className="fw-bold">Everything you need to ship faster</h2>
                            <p className="text-muted">
                                A batteries-included base so you can focus on your product, not on setup.
                            </p>
                        </div>
                    </div>
                    <div className="row g-4">
                        {features.map((feature) => (
                            <div className="col-md-6 col-lg-3" key={feature.title}>
                                <div className="card h-100 shadow-sm">
                                    <div className="card-body">
                                        <h3 className="h5 card-title">{feature.title}</h3>
                                        <p className="card-text text-muted mb-0">{feature.text}</p>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Call to action */}
            <section id="cta" className="bg-primary text-white py-5">
                <div className="container text-center py-3">
                    <h2 className="fw-bold">Start building today</h2>
                    <p className="mx-auto mb-4" style={{ maxWidth: '40rem' }}>
                        Clone the repository, run the setup commands and ship your next idea in minutes.
                    </p>
                    <a href="#" className="btn btn-light btn-lg px-4">
                        View on GitHub
                    </a>
                </div>
            </section>
        </React.Fragment>
    );
}

export default Landing;

if (document.getElementById('app-root')) {
    ReactDOM.render(<Landing />, document.getElementById('app-root'));
}
