export const setMachine = (state, payload) => {
    state.machine = payload;
};

export const setEmployeeId = (state, payload) => {
    state.machine.employee_id = payload;
};

export const setMACAddress = (state, payload) => {
    state.machine.MAC_Address = payload;
};
