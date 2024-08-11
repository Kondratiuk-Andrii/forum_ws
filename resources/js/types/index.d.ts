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
    section_title: string;
    parent_id: number | null;
    parent_title: string;
    children?: IBranch[];
    themes?: ITheme[];
}

export interface ITheme {
    id: number;
    title: string;
    description: string;
    branch: IBranch;
    messages?: IMessage[];
}

export interface IMessage {
    id: number;
    content: string;
    theme_id: number;
    is_liked: boolean;
    likes: number;
    is_not_solved_complaint: boolean;
    user: IUser;
    time: string;
}

export interface IFlash {
    message: {
        title: string;
        icon: 'success' | 'error' | 'warning' | 'info' | 'question';
    };
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: IUser;
    };
};
