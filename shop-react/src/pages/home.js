import React,{Component} from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {throws} from 'assert'
import '../styles.css'



 class Home extends Component{

   constructor(){
    super();
    this.state={
      qty:'',
      home: [], isLoading: true, error: null 
    }
    this.qty = this.qty.bind(this);
    this.handleClick = this.handleClick.bind(this);
  }

  componentDidMount() {
    fetch('http://127.0.0.1:8000/api/getAllArticles')
      .then(res => res.json())
      .then(json => {
        this.setState({
          isLoading: false,
          home: json.data,
        });
      })
      .catch(error =>
        this.setState({ error: error.message, isLoading: false }),
      );
  }
  
  qty(e){
    console.log(e.target.value);
    this.setState({qty:e.target.value})
    }

  
  handleClick(e) {
    let article_id = e.target.value;
    fetch('http://127.0.0.1:8000/api/addtoCart', {
      method: 'POST',
      headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({
          article_id: article_id,
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
 
    return (
    <div>
      <center><h1>Products List</h1></center>
      <div className="row">
      {this.state.home.map((home1) => (
        <div class="col-md py-3">
          <div class="card card-body">
            <img className="fixed_img" src={require("../"+home1.image)} alt="Image" />
            <h5 class="card-title">{home1.title}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{home1.description}</h6>
            <p class="card-text">Price:{home1.price} &euro;</p>
            <p class="card-text">Quantity: <input type="number"  onChange={this.qty} className="w-25"   /></p>
            <button value={home1.title} className="btn btn-primary" index={home1.id} onClick={this.handleClick}>Buy <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
          </div>
        </div>
      ))}
    </div>
    </div>
  )
      }
}

export default Home;


