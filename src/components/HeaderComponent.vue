
<template>
    <nav>

        <div class="logo-sneak">
            <a href="#"><img src="../assets/logo-sneak-me-blanc.png" alt="Logo Sneak Me"></a>
        </div>

        <div class="recherche">
            <form>
                <input type="text" placeholder="Rechercher...">
                <button type="submit"><img src="../assets/rechercher-logo-blanc.png" alt="Rechercher"></button>
            </form>
        </div>

        <div class="menu-burger">
            <input type="checkbox" id="burger-checkbox" class="menu-burger-btn">
            <label for="burger-checkbox" class="menu-burger-bouton">&#9776;</label>
            <ul class="menu-burger-items">
                <li><a href="#"><img src="../assets/panier-logo.png" alt="Panier"> Panier</a></li>
                <li><a href="#"><img src="../assets/image-de-profil.png" alt="Profil"> Profil</a></li>
            </ul>
        </div>

        <div class="navigation">
            <ul>
                <li><a href="#"><img src="../assets/panier-logo-blanc.png" alt="Panier"></a></li>
                <li><a href="#"><img src="../assets/image-de-profil-blanc.png" alt="Profil"></a></li>
            </ul>
        </div>

    </nav>
</template>

<script>

export default {
    name: 'HeaderComponent'
}

</script>

<style>

/* BARRE DE NAVIGATION */

nav {
    background-color: #3975c4;
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0px 1px 20px 0px rgba(0, 0, 0, 0.774);
}

nav img:hover {
    transform: scale(1.1);
}

/* LOGO */

.logo-sneak img {
    height: 20px;
}

/* BARRE DE RECHERCHE */

.recherche {
    display: flex;
    align-items: center;
}

.recherche form {
    display: flex;
    align-items: center;
}

.recherche button {
    border: none;
    background: none;
    cursor: pointer;
}

.recherche input {
    width: 35vw;
    margin-right: 5px;
    padding: 5px 0 5px 5px;
    border: #33333300;
    border-radius: 8px;
}

.recherche img {
    height: 20px;
}

/* PANIER ET PROFIL */

.navigation ul {
    list-style: none;
    display: flex;
}

.navigation li {
    font-family: Arial, Helvetica, sans-serif;
    margin-right: 20px;
}

.navigation a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

.navigation img {
    height: 30px;
}

.menu-burger {
    display: none;
}

@media screen and (max-width: 600px) {

    .navigation,
    .menu-burger input {
        display: none;
    }

    .menu-burger {
        display: block;
        position: absolute;
        top: 12px;
        right: 0;
    }

    .recherche {
        position: absolute;
        top: 17px;
        right: 50px;
    }

    .recherche input {
        width: 20vw;
    }

    .navigation {
        display: none;
    }

    .menu-burger img {
        height: 20px;
    }

    /* Style Menu Burger */

    .menu-burger-bouton {
        background-color: transparent;
        border: none;
        color: #ffffff;
        cursor: pointer;
        font-size: 23px;
        margin-right: 20px;
    }

    .menu-burger-bouton:focus {
        outline: none;
    }

    /* Style Items menu burger */

    .menu-burger-items {
        display: none;
        flex-direction: column;
        list-style-type: none;
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        top: 32px;
        right: 0;
        background-color: #fff;
        padding: 0 20px 0 20px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .menu-burger-items li {
        margin: 10px 0 10px 0;
        width: 100px;
        text-align: left;
        padding: 0 40px 0 10px;
    }

    .menu-burger-items a {
        color: #000000;
        text-decoration: none;
    }

    /* Pour que ça marche */

    .menu-burger-btn:checked~.menu-burger-items {
        display: flex;
    }
}

@media screen and (max-width: 300px) {
    .recherche {
        display: none;
    }
}
</style>