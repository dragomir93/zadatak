import React,{Component} from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {throws} from 'assert'
import '../styles.css'

class Cart extends Component{
  constructor(){
    super();
    this.state={
      qty:'',
      cart: [], isLoading: true, error: null 
    }
    this.qty = this.qty.bind(this);
    this.update = this.update.bind(this);
  }

  componentDidMount() {
    fetch('http://127.0.0.1:8000/api/getAllCart')
      .then(res => res.json())
      .then(json => {
        this.setState({
          isLoading: false,
          cart: json.data,
        });
      })
      .catch(error =>
        this.setState({ error: error.message, isLoading: false }),
      );
  }
  
delete(e){
  let id_cart = e.target.value;
  fetch('http://127.0.0.1:8000/api/deleteCart/'+id_cart, {
    method: 'DELETE'});
   

}
qty(e){
  console.log(e.target.value);
  this.setState({qty:e.target.value})
  }


update(e) {
  let id_cart = e.target.value;
  fetch('http://127.0.0.1:8000/api/update/cart/'+id_cart, {
    method: 'PUT',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        quantity: this.state.qty
       
    })
})
.then((response) => response.json())
.then((responseJson) => {
    console.log(responseJson);
    window.location.href ="/cart";

});
}


  render(){
    var total = 0;
    return (
      
      <div>
    <div class="container">
     <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                &nbsp;Shopping cart
                <a href="/" class="btn btn-outline-info btn-sm pull-right">Continiue  shopping</a>
                <div class="clearfix"></div>
            </div>
      </div>
            <div class="card-body">
            {this.state.cart.map((cart1) => (
                  
                    <div class="row">
                    
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                        <img className="small_img" src={require("../"+cart1.image)} alt="Image" />
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-3">
                            <h4 class="product-name"><strong>{cart1.article_id}</strong></h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" >
                                <h6>Price:<strong>{cart1.price+".00"} <span class="text-muted">&euro;</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                <input type="number"  onChange={this.qty} className="small_input"  class="qty" />
                                <p>Qty:{cart1.quantity}</p>
                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-md-2 pull-right">
                                <button type="submit" value={cart1.id_cart} onClick={this.update}  index={cart1.id_cart} class="btn btn-outline-primary btn-xs sub">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="submit" value={cart1.id_cart} onClick={this.delete}  index={cart1.id_cart} class="btn btn-outline-danger btn-xs sub1">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden"  value={total += cart1.price*cart1.quantity}/> 
                    </div>
                    
                     ))}
            <div class="card-footer">
                
                <div class="pull-right" >
                    <a href="/checkout" class="btn btn-success pull-right">Checkout</a>
                    <div class="pull-right" >
                        Total price: <b>{total} .00 &euro;</b>
                    </div>
                </div>
            </div>

              </div>
              
      </div>
     
    </div>
    )
  }
}

export default Cart;

