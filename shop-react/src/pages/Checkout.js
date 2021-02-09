import React,{Component} from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {throws} from 'assert'
import '../styles.css'
import { Form, Button, FormGroup, FormControl, ControlLabel,Grid, Row, Col } from "react-bootstrap";

class Checkout extends Component{
    constructor(){
        super();
        this.state={
          name:'',
          surname:'',
          email:'',
          mobile_phone:'',
          city:'',
          country:'',
          adress:'',
          cart: [], isLoading: true, error: null 
        }
        this.name = this.name.bind(this);
        this.surname = this.surname.bind(this);
        this.email = this.email.bind(this);
        this.mobile_phone = this.mobile_phone.bind(this);
        this.city = this.city.bind(this);
        this.country = this.country.bind(this);
        this.adress = this.adress.bind(this);
        this.handleClick = this.handleClick.bind(this);
      }

      name(event){
        console.log(event.target.value);
        this.setState({name:event.target.value})
        }

        
      surname(event){
        console.log(event.target.value);
        this.setState({surname:event.target.value})
        }


        email(event){
            console.log(event.target.value);
            this.setState({email:event.target.value})
            }

        city(event){
            console.log(event.target.value);
            this.setState({city:event.target.value})
        }

        mobile_phone(event){
            console.log(event.target.value);
            this.setState({mobile_phone:event.target.value})
        }

        adress(event){
            console.log(event.target.value);
            this.setState({adress:event.target.value})
        }

        country(event){
            console.log(event.target.value);
            this.setState({country:event.target.value})
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

      handleClick = (event) => {
        event.preventDefault();
        fetch('http://127.0.0.1:8000/api/userCheckout', {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({
              name: this.state.name,
              surname: this.state.surname,
              email: this.state.email,
              adress:this.state.adress,
              city:this.state.city,
              country:this.state.country,
              mobile_phone: this.state.mobile_phone,
          })
      })
      .then((response) => response.json())
      .then((responseJson) => {
          console.log(responseJson);
          
    
      });

      fetch('http://127.0.0.1:8000/api/add/order/history', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          article_id:this.state.cart[0].article_id,
          email: this.state.email
        })
    })
    .then((response) => response.json())
    .then((responseJson) => {
        console.log(responseJson);
        console.log(this.state.cart[0].article_id);
  
    });

      fetch('http://127.0.0.1:8000/api/dropAll/', {
        method: 'DELETE'});



      }
      

  render(){
    var i = 0;
    return (
  
     <div>
         <h1>Purched products:</h1>
         <table class="table">
         <thead>
         <tr>
           <th scope="col">#</th>
           <th scope="col">Image</th>
           <th scope="col">Product</th>
           <th scope="col">Quantity</th>
           <th scope="col">Price per one</th>
           <th scope="col">Total Price</th>
         </tr>
        </thead>
         {this.state.cart.map((cart1) => (
       <tbody>
         <tr>
           <th scope="row">{i+=1}</th>
           <td><img className="small_img" src={require("../"+cart1.image)} alt="Image" /></td>
           <td>{cart1.article_id}</td>
           <td>{cart1.quantity}</td>
           <td>{cart1.price}.00 &euro;</td>
           <td>{cart1.price*cart1.quantity} .00 &euro;</td>
         </tr>
       </tbody>
       ))}
       
    </table>
  <h3>Fill data for user checkout:</h3>
    <Form  onSubmit={this.handleClick}>
  <Form.Row>
    <Form.Group as={Col} controlId="formGridEmail">
      <Form.Label>Name</Form.Label>
      <Form.Control type="text" placeholder="Enter name" onChange={this.name} />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridPassword">
      <Form.Label>Surname</Form.Label>
      <Form.Control type="text" placeholder="Enter surname" onChange={this.surname}/>
    </Form.Group>
  </Form.Row>

  <Form.Row>
    <Form.Group as={Col} controlId="formGridEmail">
      <Form.Label>Email</Form.Label>
      <Form.Control type="email" placeholder="Enter email"  onChange={this.email} />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridPassword">
      <Form.Label>Mobile phone</Form.Label>
      <Form.Control type="text" placeholder="Enter mobile phone"   onChange={this.mobile_phone}/>
    </Form.Group>
  </Form.Row>

  <Form.Row>
    <Form.Group as={Col} controlId="formGridCity">
      <Form.Label>Adress</Form.Label>
      <Form.Control type="text" placeholder="Enter adress"  onChange={this.adress} />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridCity">
      <Form.Label>City</Form.Label>
      <Form.Control type="text" placeholder="Enter city"  onChange={this.city}/>
    </Form.Group>

    <Form.Group as={Col} controlId="formGridZip">
      <Form.Label>Country</Form.Label>
      <Form.Control type="text" placeholder="Enter country"   onChange={this.country}/>
    </Form.Group>
  </Form.Row>

  <Button variant="primary" type="submit">
    Purchase
  </Button>
</Form>
    </div>
    )
  }
}

export default Checkout;
