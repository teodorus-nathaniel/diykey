const hearts = [...document.getElementsByClassName('heart')];
const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
}

hearts.forEach((el) => {
    el.addEventListener('click', function() {
        let currentClass, addedClass;
        if(this.children[0].classList.contains('fa-heart')) {
            currentClass = 'fa-heart';
            addedClass = 'fa-heart-o';
        } else if(this.children[0].classList.contains('fa-heart-o')) {
            currentClass = 'fa-heart-o';
            addedClass = 'fa-heart';
        }

        const productId = this.dataset.product;
        fetch('/favourites', {
            method: 'POST',
            credentials: 'same-origin',
            headers,
            body: JSON.stringify({
                productId
            }),
        }).then((data) => data.json()).then((data) => {
            if(data.status === 'success') {
                this.children[0].classList.remove(currentClass);
                this.children[0].classList.add(addedClass);
            }
        })
    })
})

const products = document.getElementsByClassName('product');
Array.from(products).forEach((el) => {
    el.addEventListener('click', function(e) {
        const a = document.getElementById(`link-${this.dataset.product}`); 
        if(a && !e.target.classList.contains('fa-heart') && !e.target.classList.contains('fa-heart-o')) a.click()
    }) 
})

function formatNumber(num) {
    return 'Rp. ' + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}

const grandTotalText = document.getElementById('grand-total');
function calculateGrandTotal() {
    let grandTotal = 0;
    Array.from(document.getElementsByClassName('subtotal')).forEach((el) => {
        grandTotal += +el.textContent.slice(4).replace(/\./g, '');
    })
    grandTotalText.textContent = formatNumber(+grandTotal);
}
if(grandTotalText) {
    calculateGrandTotal();
}

function updateData(inputField, qty, productId) {
    inputField.value = qty;
    const originalQty = inputField.dataset.qty;
    if(originalQty != qty) {
        document.getElementById(`buttons-${productId}`).classList.remove('hide');
    } else {
        document.getElementById(`buttons-${productId}`).classList.add('hide');
    }

    document.getElementById(`subtotal-${productId}`).textContent = formatNumber(+qty * inputField.dataset.price);

    const updateButton = document.getElementById(`update-${productId}`);
    const removeButton = document.getElementById(`remove-${productId}`);
    if(qty <= 0) {
        removeButton.classList.remove('hide')
        updateButton.classList.add('hide')
    } else {
        removeButton.classList.add('hide')
        updateButton.classList.remove('hide')
    }

    calculateGrandTotal()
}

const arrowsQty = document.getElementsByClassName('arrow-qty');
Array.from(arrowsQty).forEach((el) => {
    el.addEventListener('click', function(e) {
        const productId = this.dataset.product;
        const qtyInput = document.getElementById(`qty-${productId}`);
        let finalInput = +(qtyInput.value);

        if(this.classList.contains('fa-angle-down')) {
            finalInput--;
        } else if(this.classList.contains('fa-angle-up')) {
            finalInput++;
        }

        updateData(qtyInput, finalInput, productId);
    });
})

Array.from(document.getElementsByClassName('qty')).forEach((el) => {
    el.addEventListener('change', function(e) {
        const qty = this.value;
        updateData(this, qty, this.dataset.product);
    })
})


const inputs = document.getElementsByClassName('data-listen');
Array.from(inputs).forEach((el) => {
    el.addEventListener('change', function(e) {
        const id = this.id;
        const previewId = `preview-${id}`;
        const dom = document.getElementById(previewId);
        dom.textContent = this.value;
        if(id === 'category') {
            dom.textContent = Array.from(this.children).find((el) => el.value === this.value).textContent;
        } else if(id === 'image') {
            const url = URL.createObjectURL(this.files[0]);
            dom.src = url;
        } else if(id === 'price') {
            dom.textContent = formatNumber(this.value)
        }
    });
})


require('./bootstrap');