import React, { Component } from 'react';
import PropTypes from 'prop-types';
import FacebookLogin from 'react-facebook-login';

class AuthFacebookLogin extends Component {

  _loginResponse = (response) => {
    if( response.userID && response.accessToken ){
      this.props.onSuccessLogin( response )
    }
  }

  render() {
    return (
      <FacebookLogin
        appId="2181565752079299"
        autoLoad={true}
        fields="name,email,picture"
        // onClick={componentClicked}
        scope="public_profile,manage_pages,pages_show_list,instagram_basic"
        callback={this._loginResponse}
      />
    )
  }
}

AuthFacebookLogin.propTypes = {
  onSuccessLogin: PropTypes.func.isRequired
};

export default AuthFacebookLogin