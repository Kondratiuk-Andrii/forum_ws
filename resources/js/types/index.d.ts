export interface IUser {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface ISection {
    id: number;
    title: string;
    branches?: IBranch[];
}

export interface IBranch {
    id: number;
    title: string;
    section_id: number;
    parent_id: number;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: IUser;
    };
};
