<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Morgue</title>
</head>
<body>

<header>
    <div class="logo"><img src="logo.png" class="img" alt=""></div>
    <nav>
        <a href="#">Início</a>
        <a href="#inicio">Funcionalidades</a>
        <a href="#sobre">Sobre</a>
        <a href="#contacto">Contacto</a>
        <a href="cadastro.php" class="btn-login">Cadastrar-se</a>
    </nav>
</header>

<section class="hero" id="inicio">
    <div class="hero-content">
        <h1>Sistema de Gestão de Morgue</h1>
        <p>
            Plataforma digital para registo,
            consulta e controlo de informações
            mortuárias de forma segura e eficiente.
        </p>
        <a href="login.php" class="btn-principal">
            ACESSAR SISTEMA
        </a>
    </div>
</section>

<section class="funcionalidades" id="funcionalidades">
    <h2>Funcionalidades</h2>
    <div class="cards">
        <div class="card">
            <h3>Cadastro</h3>
            <p>Registo completo de corpos e informações associadas.</p>
        </div>
        <div class="card">
            <h3>Consultas</h3>
            <p>Pesquisa rápida e organizada dos registros.</p>
        </div>
        <div class="card">
            <h3>Relatórios</h3>
            <p>Geração de relatórios administrativos e estatísticos.</p>
        </div>
        <div class="card">
            <h3>Utilizadores</h3>
            <p>Gestão de acessos e permissões do sistema.</p>
        </div>
    </div>
</section><br><br>

<section class="estatisticas">
    <div class="numero">
        <h2>2500+</h2>
        <p>Registros</p>
    </div>
    <div class="numero">
        <h2>35+</h2>
        <p>Utilizadores</p>
    </div>
    <div class="numero">
        <h2>99%</h2>
        <p>Segurança</p>
    </div>
</section>

<section class="sobre" id="sobre">
    <h2>Sobre o Sistema</h2>
    <p>
        O Sistema de Gerenciamento de Morgue foi desenvolvido para
        garantir o armazenamento seguro, consulta rápida e gestão
        eficiente de registros mortuários, oferecendo uma plataforma
        moderna e confiável para instituições de saúde e serviços
        administrativos.
    </p>
</section>

<footer id="contacto">
    <h3>MORGUE SYSTEM</h3>
    <p>Email: arturnhanga01@gmail.com</p>
    <p>Telefone: +244 950 786 774</p>
    <p>© 2026 Todos os direitos reservados.</p>
</footer>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #ffffff;
    color: #000000;
    line-height: 1.6;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background-color: #4da6ff;
    color: #ffffff;
    position: sticky;
    top: 0;
    z-index: 1000;
}

header .logo img {
    width: 120px;
    height: 80px;
    height: auto;
}

header nav a {
    color: #ffffff;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
    transition: 0.3s;
}

header nav a:hover {
    text-decoration: underline;
}

header nav .btn-login {
    background-color: #ffffff;
    color: #4da6ff;
    padding: 8px 15px;
    border-radius: 5px;
    transition: 0.3s;
}

header nav .btn-login:hover {
    background-color: #e6f2ff;
}

.hero {
    background-color: #e1ebf5;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 100px 20px;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #000000;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    color: #000000;
}

.hero .btn-principal {
    background-color: #4da6ff;
    color: #ffffff;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.hero .btn-principal:hover {
    background-color: #3399ff;
}

.funcionalidades {
    padding: 0px 20px;
    text-align: center;
}

.funcionalidades h2 {
    font-size: 2rem;
    margin-bottom: 40px;
    color: #000000;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    background-color: #ffffff;
    border: 2px solid #4da6ff;
    border-radius: 10px;
    padding: 30px 20px;
    transition: 0.3s;
}

.card h3 {
    margin-bottom: 15px;
    color: #4da6ff;
}

.card p {
    color: #000000;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.estatisticas {
    background-color: #4da6ff;
    color: #ffffff;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 50px 20px;
    flex-wrap: wrap;
    text-align: center;
}

.estatisticas .numero h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.estatisticas .numero p {
    font-size: 1.2rem;
}

/* Sobre */
.sobre {
    padding: 80px 20px;
    text-align: center;
}

.sobre h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #000000;
}

.sobre p {
    max-width: 800px;
    margin: 0 auto;
    color: #000000;
}

/* Footer */
footer {
    background-color: #000000;
    color: #ffffff;
    text-align: center;
    padding: 30px 20px;
}

footer h3 {
    margin-bottom: 15px;
}

footer p {
    margin-bottom: 5px;
}

/* Responsividade */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    header nav {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .hero {
        padding: 70px 20px;
    }

    .hero h1 {
        font-size: 2rem;
    }

    .cards {
        gap: 20px;
    }

    .estatisticas {
        flex-direction: column;
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .hero h1 {
        font-size: 1.5rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .cards {
        grid-template-columns: 1fr;
    }
}
</style>
</body>
</html>