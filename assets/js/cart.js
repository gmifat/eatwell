const setCartProduct = (event) => {
    /*console.log(event);
    console.log(event.submitter);*/
    let form = event.target;
    let action = event.submitter.dataset.action;
    let quantity = form['quantity'].value;
    window.fetch(`${form.action}&action=${action}&quantity=${quantity}`).then(
        result => {
            console.log(result.clone().text());
            return result.json()
        }
    ).then(
        data => {
            console.log(data);
            let cart = document.querySelector('[data-cart]');
            cart.dataset.cart = data.cart.count;

            let message = document.getElementById(`user-message-content-${data.product_id}`);
            if (message == null)
            {
                message = document.getElementById('user-message-content-0');
            }

            let parent = message.parentElement;
            parent.removeChild(message);
            message = document.createElement('div');
            message.id = `user-message-content-${data.product_id}`;
            parent.appendChild(message);
            message.className = 'user-message-content';

            if(data.success)
            {
                if(action === 'add')
                {
                    form['add'].style.display = 'none';
                    form['edit'].style.display = 'block';
                    form['remove'].style.display = 'block';
                }
                else if(action === 'remove')
                {
                    form['add'].style.display = 'flex';
                    form['edit'].style.display = 'none';
                    form['remove'].style.display = 'none';
                }

                message.innerHTML = data.message_ok;
                message.className = 'user-message-content animation';
            }
            else
            {
                message.innerHTML = data.message_ko;
                message.className = 'user-message-content animation';
            }
        }
    ).catch(
        error => console.log(error)
    );
};

const getCartContent = () => {
    window.fetch(`controllers/cartController.php?action=content`).then(
        result => {
            return result.json()
        }
    ).then(
        json => {
            let score_data = json;
            bestScore.content = score_data.best_score;
            tableContent = '';

            const scoresList = score_data.scores.map(score => {
                tableContent += `<tr><th scope="row">${score.rank}</th><td>${score.username}</td><td>${score.value}</td></tr>`;
            });

            tableContainer.innerHTML = tableStart + tableContent + tableEnd;
        }
    ).catch(
        error => console.log(error)
    );
};
