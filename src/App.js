
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import ProductList from './Pages/ProductList';
import AddProduct from './Pages/AddProduct';


function App() {
  return (
    <div className="wrapper m-5">
      <BrowserRouter>
      <Routes>
          <Route index path="/" element={<ProductList />} />
          <Route path="/add-product" element={<AddProduct />} />
      </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
