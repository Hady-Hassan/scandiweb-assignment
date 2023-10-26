import React from 'react'

function Footer() {
  return (
    <div className='w-100 text-center'>
        {/* make a black hr with 80% width */}
        <hr style={{width: '100%'}} className="bg-dark"/> 
        <footer className="w-100 ">
            <h6 className="mx-auto">Scandiweb Test Assignment</h6>
        </footer>
  
    </div>
  )
}

export default Footer