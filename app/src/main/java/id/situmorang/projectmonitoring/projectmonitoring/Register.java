package id.situmorang.projectmonitoring.projectmonitoring;


import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import butterknife.Bind;
import butterknife.ButterKnife;

public class Register extends AppCompatActivity {
    private static final String TAG = "SignupActivity";

    @Bind(R.id.input_name)
    EditText _nameText;
    @Bind(R.id.input_user)
    EditText _userText;
    @Bind(R.id.input_password)
    EditText _passwordText;
    @Bind(R.id.btn_signup)
    Button _signupButton;
    @Bind(R.id.link_login)
    TextView _loginLink;
    Spinner sp;
    AlertDialog.Builder builder;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        ButterKnife.bind(this);
        sp = (Spinner) findViewById(R.id.spPosition);
        // Create an ArrayAdapter using the string array and a default spinner layout
        ArrayAdapter<CharSequence> pst = ArrayAdapter.createFromResource(this,
                R.array.position, android.R.layout.simple_spinner_item);
        pst.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp.setAdapter(pst);
        String position = sp.getSelectedItem().toString();

        builder = new AlertDialog.Builder(Register.this);

        _signupButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                signup();

            }
        });

        _loginLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Finish the registration screen and return to the Login activity
                finish();
            }
        });
    }

    public void signup() {
        Log.d(TAG, "Signup");

        if (!validate()) {
            onSignupFailed();
            return;
        }
        signupUser();
        _signupButton.setEnabled(false);


        final ProgressDialog progressDialog = new ProgressDialog(Register.this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Creating Account...");
        progressDialog.show();

        String name = _nameText.getText().toString();
        String username = _userText.getText().toString();
        String password = _passwordText.getText().toString();

        // TODO: Implement your own signup logic here.

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {

                        progressDialog.dismiss();
                    }
                }, 3000);
    }


    public void onSignupSuccess() {
        setResult(RESULT_OK, null);
        _nameText.setText("");
        _passwordText.setText("");
        _userText.setText("");
        sp.setSelection(0);
        _signupButton.setEnabled(true);


    }


    public void onSignupFailed() {
        builder.setTitle("Warning!!!");
        builder.setMessage("Please Fill all the fields");
        displayAlert("Failed");
    }


    public boolean validate() {
        boolean valid = true;
        String position = sp.getSelectedItem().toString() ;
        String name = _nameText.getText().toString();
        String username = _userText.getText().toString();
        String password = _passwordText.getText().toString();

        if (name.isEmpty() || name.length() < 3) {
            _nameText.setError("Minimum name Must be 3 characters");
            valid = false;
        } else {
            _nameText.setError(null);
        }

        if (username.isEmpty() ) {
            _userText.setError("your Username require");
            valid = false;
        } else {
            _userText.setError(null);
        }

        if (password.isEmpty() || password.length() < 6 ) {
            _passwordText.setError("Minimum Password Must be 6 characters");
            valid = false;
        } else {
            _passwordText.setError(null);
        }
        if (position.equals("-Select Position-")){
            valid=false;
        }


        return valid;
    }

    public void signupUser(){
        String url ="http://192.168.137.29/pmonitoring/register.php";
        StringRequest stringRequest = new StringRequest(Request.Method.POST,url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String status="" ;
                String message="" ;



                try {
                    JSONArray jArray = new JSONArray(response);
                    JSONObject jObj =jArray.getJSONObject(0);
                    status = jObj.getString("status");
                    message = jObj.getString("message");

                } catch (JSONException e) {
                    e.printStackTrace();
                }


                if (status.equalsIgnoreCase("error")){
                    builder.setTitle("Warning!!!");
                    builder.setMessage(message);
                    displayAlert("error");
                    _signupButton.setEnabled(true);
                }else if(status.equalsIgnoreCase("error_connection")){
                    builder.setTitle("Warning!!!");
                    builder.setMessage(message);
                    displayAlert("error_connection");
                    _signupButton.setEnabled(true);
                }else if(status.equalsIgnoreCase("success")){
                    builder.setTitle("Message");
                    builder.setMessage(message);
                    displayAlert("success");
                }else {
                    builder.setTitle("Warning!!!");
                    builder.setMessage("there is a problem with your database connection");
                    displayAlert("error");
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError volleyError) {
                if (volleyError instanceof TimeoutError) {
                }
            }
        }) {
            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> headers = new HashMap<>();
                headers.put("username",_userText.getText().toString());
                headers.put("password",_passwordText.getText().toString());
                headers.put("name",_nameText.getText().toString());
                headers.put("position", sp.getSelectedItem().toString());
                return headers;
            }

            @Override
            public Priority getPriority() {
                return Priority.IMMEDIATE;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void displayAlert(final String status) {

        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                if (status.equals("success")){
                    onSignupSuccess();

                }else if (status.equals("error")){
                    _passwordText.setText("");
                    _userText.setText("");
                    _nameText.setText("");
                    _signupButton.setEnabled(true);
                }else if (status.equals("Failed")){
                    _signupButton.setEnabled(true);
                }else if(status.equals("error_connection")){
                    _passwordText.setText("");
                    _userText.setText("");
                    _nameText.setText("");
                }

            }
        });
        AlertDialog alertDialog = builder.create();
        alertDialog.show();

    }
}


