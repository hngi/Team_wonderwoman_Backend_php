let api = [
  {
    api_name: "user manager",

    endpoints: [
      {
        endpoint_name: "add user",
        method: "post",
        required_params: [
          { param_name: "name", type: "text" },
          { param_name: "eamil", type: "email" },
          { param_name: "phone number", type: "number" },
        ],
      },
      {
        endpoint_name: "delete user",
        method: "delete",
        required_params: [{ param_name: "id", type: "text" }],
      },
    ],
  },
];
