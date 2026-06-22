import { Navigate } from "react-router-dom";

function ProtectedRoute({
  children,
  adminOnly = false,
}) {

  const isLoggedIn =
    localStorage.getItem(
      "isLoggedIn"
    );

  const role =
    localStorage.getItem(
      "role"
    );

  // NOT LOGGED IN
  if (!isLoggedIn) {

    return (
      <Navigate
        to="/"
        replace
      />
    );
  }

  // STAFF TRYING TO ACCESS ADMIN PAGE
  if (
    adminOnly &&
    role !== "admin"
  ) {

    return (
      <Navigate
        to="/create-invoice"
        replace
      />
    );
  }

  return children;
}

export default ProtectedRoute;