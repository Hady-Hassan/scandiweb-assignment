import React from 'react'
import Header from '../Layout/Header'
import Footer from '../Layout/Footer'
import ProductCard from '../Components/ProductCard'
import { Link } from 'react-router-dom'
import data from '../data.json'
import { useState } from 'react'
import { useEffect } from 'react'
import axios from 'axios'

function ProductList() {

  const [products, setProducts] = useState([])
  const [selected, setSelected] = useState([])


  //get data from api
  useEffect(() => {
    getProducts()
  }, [])

  const getProducts = () => {
    fetch(process.env.REACT_APP_BASE_URL)
      .then(res => res.json())
      .then(data => {
        setProducts(data)
      })
  }
  const handleSelect = (e) => {
    if (e.target.checked) {
      setSelected([...selected, e.target.value])
      console.log(selected)
    }
    else {
      setSelected(selected.filter(sku => sku !== e.target.value))
    }
  }

  const handleDelete = () => {
    let newProducts = products.filter(product => !selected.includes(product.sku))
    setProducts(newProducts)
    console.log(selected)
    fetch(process.env.REACT_APP_BASE_URL, {
      method: 'DELETE',
      headers: {
        withCredentials: true,
        Accept: 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(selected)
    })
      .then(res => {
        console.log(res)
      }).finally(() => {
        setSelected([])
        reversecheck()
        getProducts()
      })

  }

  function reversecheck() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox') {
        if (checkboxes[i].checked == true)
          checkboxes[i].checked = !checkboxes[i].checked;
      }
    }
  }

  return (
    <div>
      <Header title="Product List">
        <Link to="/add-product">
          <button class="btn btn-primary m-1">ADD</button>
        </Link>
        <button class="btn btn-danger m-1" id='delete-product-btn' onClick={handleDelete}>MASS DELETE</button>
      </Header>
      <div class="container-fluid">
        <div class="row">
          {products.map(product => (
            <div class="col-md-3">
              <div className="card border border-dark text-center m-3">
                <input type="checkbox" className="delete-checkbox form-check-input m-2 " value={product.sku} onChange={handleSelect} />
                <ProductCard
                  sku={product.sku}
                  name={product.name}
                  price={product.price}
                  attr={product.attr}
                />
                </div>
              
            </div>
          ))}
        </div>
      </div>
      <Footer />
    </div>
  )
}

export default ProductList
