import React from 'react'
import Header from '../Layout/Header'
import Footer from '../Layout/Footer'
import { Link } from 'react-router-dom'
import form from "../form.json"
import { useState } from 'react'
import axios from 'axios'

function AddProduct() {
  const forms = form
  const [type, setType] = useState();
  const [product, setProduct] = useState({});
  const handletypeChange = (e) => {
    setType(forms.filter(form => form.type === e.target.value)[0]  );
   
     setProduct({ ...product, "type": e.target.value });
    
    console.log(product);
    
  }

  const handleChange = (e) => {
    const target = e.target;
    const value = target.value;
    const name = target.id;
 
    setProduct({ ...product, [name]: value });

    console.log(product);
  }


  
  const handleSubmit = (e) => {
    e.preventDefault();
    const types = document.getElementById("productType");
    const value = types.options[types.selectedIndex].value;
    setProduct({ ...product, "type": value });


    if (check()) {
      axios.post('http://localhost/ScandiTest/Functions/EndPoint.php', {

      headers:{
        withCredentials: true,
        Accept: 'application/json',
        'Content-Type': 'application/json'
    },
      data: product
    })
      .then(res => {
        console.log(res)
      }).finally(() => {
        window.location.href = "/";
        
      })
    }
    else {
      alert("Please, submit required data")
    }
    console.log(product);
    
  }
  function check() {
    if (!product["name"] && product["sku"] && product["price"] && product["type"]) {
      return false;
    }
    if (!type) {
      return false;
    }
    const attr = type.fields;

    for (let i = 0; i < attr.length; i++) {
      if (product[attr[i].toLowerCase()] === undefined) {
        return false;
      }
    }
    return true;
    
  }

  const ValidateNumber = (e) => {
    const re = /^[0-9\b]+$/;
    if (e.target.value === '' || re.test(e.target.value)) {
      const target = e.target;
      const value = parseInt(target.value) ;
      const name = target.id;
      setProduct({ ...product, [name]: value });
      
      console.log(product);
    }
    else{
      alert("Please enter only numbers.")
    }
  }

  return (
    <div>
      <Header title="Add Product">
        <button className="btn btn-primary m-1" onClick={handleSubmit}>Save</button>
        <Link to="/">
          <button className="btn btn-danger m-1">Cancel</button>
        </Link>
      </Header>
      <form id='product_form'>
        <table className="" style={
          {
            width: "50%"
          }
        }
          border="0"
        >
          <tbody>
            <tr>
              <td><label for="sku">SKU</label></td>
              <td><input type="text" className="form-control" id="sku" placeholder="SKU-1234567890" onChange={handleChange} required/></td>
            </tr>
            <tr>
              <td><label for="name">Name</label></td>
              <td><input type="text" className="form-control" id="name" placeholder="Product Name" onChange={handleChange} required /></td>
            </tr>
            <tr>
              <td><label for="price">Price ($)</label></td>
              <td><input type="number" className="form-control" id="price" min="0" onChange={ValidateNumber} placeholder="0.00" required/></td>
            </tr>
            <tr>
              <td><label for="price">Type Switcher</label></td>
              <td>
                <select className="form-control" id="productType" onChange={handletypeChange} required>
                  <option hidden disabled selected ></option>
                  <option value="DVD">DVD</option>
                  <option value="Furniture">Furniture</option>
                  <option value="Book">Book</option>
                </select>
              </td>
            </tr>
           {
              type ? type.fields.map(attr => (
                <tr key={attr.toLowerCase()}>
                  <td><label for={attr}>{attr + " ("+type.units+")"}</label></td>
                  <td><input key={attr.toLowerCase()}  type="number" className="form-control" id={attr.toLowerCase()} placeholder="0"  onChange={ValidateNumber} required /></td>
                </tr>
              ))
              
               : null
           }
           {
            type ? 
            <tr>
              <td colSpan={2} > <h5 className='m-left'>{type.description}</h5></td>
              
            </tr>
            : null
           }

           

          </tbody>
        </table>


      </form>
      <Footer />
    </div>
  )
}

export default AddProduct

