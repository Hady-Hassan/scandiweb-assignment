import React from 'react'

export default function Header(props) {
  return (
    <div>
      <div className='d-flex '>
        <div className="p-2">
          <h1>{props.title}</h1>
        </div>
        <div className="ml-auto p-2">
          {props.children}
        </div>



      </div>
      <hr style={{ width: '100%' }} className="bg-dark" />
    </div>

  )
}
