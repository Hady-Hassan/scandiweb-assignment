import React from 'react'
import { useState } from 'react'

function ProductCard(props) {
  return (
    <div>
            <div className="card-body">
                <h5 className="card-title">{props.sku}</h5>
                <h5 className="card-title">{props.name}</h5>
                <h5 className="card-title">{props.price}.00$</h5>
                <h5 className="card-title">{props.attr}</h5>
            </div>
       
    </div>
  )
}

export default ProductCard