<main class="main-policy">
    <section class="row">
        <article class="delete-item">
            <h1>Formulaire de contact</h1>
            <div>
                <div>
                    <h2 class="delete-title">EatWell répond à vos questions sur tous les sujets !</h2>

                    <p class="delete-body">Exprimez vous et donnez-nous un maximum de détails, merci de choisir la bonne rubrique pour que votre demande soit orienter au bon service</p>
                </div>
                <div class="delete-personal-form row">
                    <fieldset>
                        <form method="POST" action="index.php?p=contact">
                            <div class="delete-form-container">
                                <label for="last_name">Nom</label>
                                <input required name="last_name" type="text" id="last_name">
                            </div>
                            <div class="delete-form-container">
                                <label for="first_name">Prénom</label>
                                <input required name="first_name" type="text" id="first_name">
                            </div>
                            <div class="delete-form-container">
                                <label for="email">Email</label>
                                <input required name="email" type="text" id="email">
                            </div>
                            <div class="delete-form-container">
                                <label for="phone">Téléphone</label>
                                <input name="phone" type="text" id="phone">
                            </div>
                            <div class="row delete-form-container">
                                <label for="subject">Sujet</label>
                                <select required style="color: #757575" name="subject" type="text" id="subject">
                                    <option value="order">Commande en ligne</option>
                                    <option value="product">Information sur un produit</option>
                                    <option value="order">Réclamation</option>
                                    <option value="order">Autres demandes</option>
                                </select>
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
