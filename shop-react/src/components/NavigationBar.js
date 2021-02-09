import React, { Component } from 'react'
import { Link } from "react-router-dom";
import { Nav, Navbar } from "react-bootstrap";
import styled from "styled-components";
import ReactDOM from 'react-dom'
import axios from 'axios'
import {throws} from 'assert'
import '../styles.css'


const Styles = styled.div`
  .navbar {
    background-color: #222;
  }
  a,
  .navbar-brand,
  .navbar-nav .nav-link {
    color: #bbb;
    &:hover {
      color: white;
    }
  }
`;

const icon = <i class="fa fa-shopping-cart" aria-hidden="true"></i>

class NavigationBar extends Component {

  state={ cart: [], isLoading: true, error: null }

  componentDidMount() {
    fetch('http://127.0.0.1:8000/api/getCartNumber')
      .then(res => res.json())
      .then(result => {
        this.setState({
          isLoaded: true,
          cart: result.total
        });
      });
  }
  
  render() {
    return (
  <Styles>
    <Navbar expand="lg">
      <Navbar.Brand href="/">Company</Navbar.Brand>
      <Navbar.Toggle aria-controls="basic-navbar-nav" />
      <Navbar.Collapse id="basic-navbar-nav">
        <Nav className="ml-auto">
          <Nav.Item>
            <Nav.Link as={Link} to="/">
              Home
            </Nav.Link>
          </Nav.Item>
          <Nav.Item>
            <Nav.Link as={Link} to="/orderHistory">
              Order History
            </Nav.Link>
          </Nav.Item>
          <Nav.Item>
            <Nav.Link  as={Link} to="/cart">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;
              <span class="badge badge-light">{this.state.cart}</span>
            </Nav.Link>
          </Nav.Item>
        </Nav>
      </Navbar.Collapse>
    </Navbar>
  </Styles>
   );
  }
}

export default NavigationBar;