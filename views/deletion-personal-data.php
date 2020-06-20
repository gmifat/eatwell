<main class="main-policy">
    <section class="row">
        <article class="delete-item">
            <h1>Gestion de mes informations personnelles</h1>
            <div>
                <div>
                    <h2 class="delete-title">Demande de suppression de mes données personnelles</h2>
                    <p class="delete-body">Dans le cadre de la loi RGPD, vous disposez de ce formulaire pour nous faire part de votre souhait de suppression de l'ensemble de vos données collectées par le biais de notre site internet.</p>
                    <p class="delete-body">Nous procèderons à la suppression de l'ensemble de vos informations présent dans nos bases de données dans un délai d'un mois selon la législation en vigueur</p>
                </div>
                <div class="delete-personal-form row">
                    <fieldset>
                        <form method="POST" action="deletion-personal-data.php">
                            <div class="delete-form-container">
                                <label for="last_name">Nom</label>
                                <input name="last_name" type="text" id="last_name">
                            </div>
                            <div class="delete-form-container">
                                <label for="first_name">Prénom</label>
                                <input name="first_name" type="text" id="first_name">
                            </div>
                            <div class="delete-form-container">
                                <label for="email">Email</label>
                                <input name="email" type="text" id="email">
                            </div>
                            <div class="delete-form-container">
                                <label for="phone">Téléphone</label>
                                <input name="phone" type="text" id="phone">
                            </div>
                            <div class="row delete-form-container">
                                <label for="subject">Sujet</label>
                                <input style="color: #757575" name="subject" type="text" id="subject" value="Demande de suppression de mes données personnelles">
                            </div>
                            <div class="row delete-form-container">
                                <label for="message">Message</label>
                                <textarea class="form-control" required="" name="message" cols="50" rows="10" id="message" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 269px;"></textarea>
                            </div>
                            <input type="submit" value="Envoyer" class="delete-button">
                        </form>
                    </fieldset>
                </div>
            </div>
        </article>
    </section>
</main>
