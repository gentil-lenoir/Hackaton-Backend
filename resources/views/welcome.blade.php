<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProAI - AI Business & Career Copilot</title>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #0f172a;
    color: #fff;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    padding: 20px 50px;
    background: #020617;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #38bdf8;
}

.nav-links a {
    margin: 0 15px;
    text-decoration: none;
    color: #fff;
}

/* HERO */
.hero {
    text-align: center;
    padding: 100px 20px;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    color: #94a3b8;
    margin-bottom: 30px;
}

/* BUTTONS */
.btn {
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.primary {
    background: #38bdf8;
    color: black;
}

.outline {
    border: 1px solid #38bdf8;
    background: transparent;
    color: #38bdf8;
}

/* SECTIONS */
.section {
    padding: 80px 50px;
    text-align: center;
}

.section.light {
    background: #020617;
}

/* CARDS */
.cards {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
}

.card {
    background: #1e293b;
    padding: 20px;
    margin: 10px;
    border-radius: 10px;
    width: 200px;
}

/* FEATURES */
.feature {
    margin: 20px 0;
}

/* CTA */
.cta {
    text-align: center;
    padding: 80px;
    background: #38bdf8;
    color: black;
}


/* FOOTER */
footer {
    text-align: center;
    padding: 20px;
    background: #020617;
}

/* =========================
   RESPONSIVE DESIGN
========================= */

/* Tablets (≤ 992px) */
@media (max-width: 992px) {

    .navbar {
        padding: 20px;
        flex-direction: column;
        align-items: center;
    }

    .nav-links {
        margin-top: 10px;
    }

    .hero h1 {
        font-size: 36px;
    }

    .section {
        padding: 60px 20px;
    }

    .cards {
        gap: 10px;
    }

    .card {
        width: 45%;
    }
}


/* Mobile (≤ 768px) */
@media (max-width: 768px) {

    .hero {
        padding: 60px 20px;
    }

    .hero h1 {
        font-size: 28px;
    }

    .hero p {
        font-size: 14px;
    }

    .hero-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .nav-links {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .nav-links a {
        margin: 10px 0;
    }

    .cards {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 90%;
    }

    .feature {
        text-align: left;
        padding: 10px;
    }
}


/* Small Phones (≤ 480px) */
@media (max-width: 480px) {

    .hero h1 {
        font-size: 22px;
    }

    .logo {
        font-size: 20px;
    }

    .btn {
        width: 100%;
    }

    .cta {
        padding: 40px 20px;
    }
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">ProAI</div>
    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#users">Users</a>
        <a href="#about">About</a>
        <button class="btn">Get Started</button>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <h1>AI Business & Career Copilot</h1>
    <p>Turn your ideas into actionable plans, strategies, and career roadmaps using AI.</p>
    <div class="hero-buttons">
        <button class="btn primary">Start Now</button>
        <button class="btn outline">Learn More</button>
    </div>
</section>

<!-- PROBLEM -->
<section class="section">
    <h2>The Problem</h2>
    <p>Many people have ideas but lack guidance, strategy, and mentorship to turn them into reality.</p>
    <div class="cards">
        <div class="card">💡 Don't know how to start a business</div>
        <div class="card">📉 Lack growth strategies</div>
        <div class="card">🎯 No clear career direction</div>
        <div class="card">🤝 No access to mentorship</div>
    </div>
</section>

<!-- SOLUTION -->
<section class="section light">
    <h2>The Solution</h2>
    <p>ProAI acts as your intelligent assistant to generate structured, actionable plans.</p>
    <div class="cards">
        <div class="card">Business Plans</div>
        <div class="card">Startup Roadmaps</div>
        <div class="card">Career Growth Plans</div>
        <div class="card">Marketing Strategies</div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="section">
    <h2>Core Features</h2>

    <div class="feature">
        <h3>🚀 Idea Validator</h3>
        <p>Analyze business ideas with SWOT, market insights, and monetization strategies.</p>
    </div>

    <div class="feature">
        <h3>📊 Startup Advisor</h3>
        <p>Generate business models, MVP features, and launch strategies.</p>
    </div>

    <div class="feature">
        <h3>🎯 Career Advisor</h3>
        <p>Get career roadmaps, skill gap analysis, and job recommendations.</p>
    </div>

</section>

<!-- USERS -->
<section id="users" class="section light">
    <h2>Who is it for?</h2>
    <div class="cards">
        <div class="card">Entrepreneurs</div>
        <div class="card">Startup Founders</div>
        <div class="card">Students</div>
        <div class="card">Job Seekers</div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h2>Start Building Your Future Today</h2>
    <button class="btn primary">Get Started</button>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2026 ProAI. All rights reserved.</p>
</footer>

<script >
 // Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href"))
            .scrollIntoView({ behavior: "smooth" });
    });
});

// Button click alert (you can replace with route later)
document.querySelectorAll(".primary").forEach(btn => {
    btn.addEventListener("click", () => {
        alert("Welcome to ProAI 🚀");
    });
});

</script>
</body>
</html>